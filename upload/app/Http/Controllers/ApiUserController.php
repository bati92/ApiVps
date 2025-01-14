<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

use App\Models\AppOrder;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
  use App\Mail\LoginEbank;
use Illuminate\Support\Facades\Mail;
class ApiUserController extends Controller 
{   public function send($role)
    {    $user=Auth::user();
         if($role=="A")
          $agents=DB::table('users')->select('*')->where('agent_id', $user->id)->where('role', 2)->get();
        else
          $agents=DB::table('users')->select('*')->where('agent_id', $user->id)->whereIn('role', [3, 4])->get();
        return response()->json(['agents'=> $agents]);  

    }
    public function getAgents()
    {    $user=Auth::user();
         //if($user->role==3)
          $agents=DB::table('users')->select('*')->where('agent_id', $user->id)->get();
        //else  if($user->role==2)
         // $agents=DB::table('users')->select('*')->where('agent_id', $user->id)->whereIn('role', [3,4])->get();
// else
      //  $agents=[];
        return response()->json(['agents'=> $agents]);  

    }    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'unique:users', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'name.required' => 'الاسم مطلوب.',
                'name.string' => 'يجب أن يكون الاسم نصاً.',
                'name.unique' => 'الاسم مستخدم بالفعل، يرجى اختيار اسم آخر.',
                'name.max' => 'يجب ألا يزيد طول الاسم عن 255 حرفًا.',
                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.string' => 'يجب أن يكون البريد الإلكتروني نصًا.',
                'email.email' => 'يرجى إدخال عنوان بريد إلكتروني صالح.',
                'email.max' => 'يجب ألا يزيد طول البريد الإلكتروني عن 255 حرفًا.',
                'email.unique' => 'البريد الإلكتروني مستخدم بالفعل، يرجى اختيار بريد آخر.',
                'password.required' => 'كلمة المرور مطلوبة.',
                'password.string' => 'يجب أن تكون كلمة المرور نصية.',
                'password.min' => 'يجب ألا تقل كلمة المرور عن 8 أحرف.',
                'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            ]);
    
            // إنشاء المستخدم
            $input = $request->all();
            $input['mobile'] = $input['code'] . $input['mobile'];
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
    
            return response()->json(['message' => 'تمت إضافة المستخدم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        }
    }
    
    
    public function storeAgent(Request $request,$agent)
    {

      try {
            $request->validate([
                'name' => ['required', 'string', 'unique:users', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'name.required' => 'الاسم مطلوب.',
                'name.string' => 'يجب أن يكون الاسم نصاً.',
                'name.unique' => 'الاسم مستخدم بالفعل، يرجى اختيار اسم آخر.',
                'name.max' => 'يجب ألا يزيد طول الاسم عن 255 حرفًا.',
                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.string' => 'يجب أن يكون البريد الإلكتروني نصًا.',
                'email.email' => 'يرجى إدخال عنوان بريد إلكتروني صالح.',
                'email.max' => 'يجب ألا يزيد طول البريد الإلكتروني عن 255 حرفًا.',
                'email.unique' => 'البريد الإلكتروني مستخدم بالفعل، يرجى اختيار بريد آخر.',
                'password.required' => 'كلمة المرور مطلوبة.',
                'password.string' => 'يجب أن تكون كلمة المرور نصية.',
                'password.min' => 'يجب ألا تقل كلمة المرور عن 8 أحرف.',
                'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            ]);
    
           $input = $request->all();
           $name = explode('_', $aget)[1];

           $type = explode('_', $aget)[0];
          $user=User::where('name',$name)->first();
   
          $input = $request->all();
          if($type=='A')
                 $input['role'] =2;
          else  if($type=='B')
                 $input['role'] =3;
          else   
          $input['role'] =4;

            $input['mobile'] = $input['code'] . $input['mobile'];
            $input['password'] = bcrypt($input['password']);
            $input['agent_id'] =$user->id;
        
            $user = User::create($input);
                    return response()->json(['message' => 'تمت إضافة المستخدم بنجاح']);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    return response()->json([
                        'status' => 'error',
                        'errors' => $e->errors(),
                    ], 422);
                }
   
    }
    public function authCheck(Request $request)
    {  
      
       if (auth()->check()) {
      
        return response()->json(['authenticated' => true ,'auth'=>Auth::user()], 200);
       }
      return response()->json(['authenticated' => false], 200);
  
    }
    public function login(Request $request)
    {   //  return response()->json("hello");
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
      
        if (Auth::attempt($credentials)) {
           
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;
            

            return response()->json(['token' => $token,'user'=>$user], 200);
        }
        else
        {
            return response()->json(['message'=>'المستخدم غير موجود'], 401);
        }
    }

    public function getLoggedInUser()
    {
        return response()->json(Auth::user());
    }

    
 
    public function myRequests($id)
    {
        // قائمة الطلبات
        $orders = collect();
    
        // جلب طلبات الخدمات
        $services = DB::table('services')
            ->join('service_orders as orders', 'services.id', '=', 'orders.service_id')
            ->where('orders.user_id', $id)
            ->select(
                'services.id',
                'services.name',
                'orders.price',
                'orders.status',
                'orders.created_at',
                'services.image_url',
                DB::raw("'Service' as type")
            )
            ->get();
    
        // جلب طلبات البرامج
        $programs = DB::table('programs')
            ->join('program_orders as orders', 'programs.id', '=', 'orders.program_id')
            ->where('orders.user_id', $id)
            ->select(
                'programs.id',
                'programs.name',
                'orders.price',
                'orders.status',
                'orders.created_at',
                'programs.image_url',
                DB::raw("'Program' as type")
            )
            ->get();
    
        // جلب طلبات الألعاب
        $games = DB::table('games')
            ->join('game_orders as orders', 'games.id', '=', 'orders.game_id')
            ->where('orders.user_id', $id)
            ->select(
                'games.id',
                'games.name',
                'orders.price',
                'orders.status',
                'orders.created_at',
                'games.image_url',
                DB::raw("'Game' as type")
            )
            ->get();
    
        // جلب طلبات الكروت
        $cards = DB::table('cards')
            ->join('card_orders as orders', 'cards.id', '=', 'orders.card_id')
            ->where('orders.user_id', $id)
            ->select(
                'cards.id',
                'cards.name',
                'orders.price',
                'orders.status',
                'orders.created_at',
                'cards.image_url',
                DB::raw("'Card' as type")
            )
            ->get();
    
        // جلب طلبات الكروت الإلكترونية
        $ecards = DB::table('ecards')
            ->join('ecard_orders as orders', 'ecards.id', '=', 'orders.ecard_id')
            ->where('orders.user_id', $id)
            ->select(
                'ecards.id',
                'ecards.name',
                'orders.price',
                'orders.status',
                'orders.created_at',
                'ecards.image_url',
                DB::raw("'Ecard' as type")
            )
            ->get();
    
        // جلب طلبات البنوك الإلكترونية
        $ebanks = DB::table('ebanks')
            ->join('ebank_orders as orders', 'ebanks.id', '=', 'orders.ebank_id')
            ->where('orders.user_id', $id)
            ->select(
                'ebanks.id',
                'ebanks.name',
                'orders.price',
                'orders.status',
                'orders.created_at',
                'ebanks.image_url',
                DB::raw("'Ebank' as type")
            )
            ->get();
    
        // جلب طلبات التحويلات
        $transferOrders = DB::table('transfer_orders')
            ->where('user_id', $id)
            ->select(
                'id',
                'price',
                'status',
                'created_at',
                DB::raw("'Transfer' as type")
            )
            ->get();
    
        // جلب طلبات التتريك
        $turkificationOrders = DB::table('turkification_orders')
            ->where('user_id', $id)
            ->select(
                'id',
                'price',
                'status',
                'created_at',
                DB::raw("'Turkification' as type")
            )
            ->get();
    
        // دمج جميع الطلبات
        $orders = $orders->merge($services)
            ->merge($programs)
            ->merge($games)
            ->merge($cards)
            ->merge($ecards)
            ->merge($ebanks)
            ->merge($transferOrders)
            ->merge($turkificationOrders);
    
        // إعادة النتائج كـ JSON
        return response()->json(["orders" => $orders]);
    }
    
    public function update(Request $request,  $id)
    { 
        try {
            $user = User::findOrFail($id);
            $input = $request->all();
            if($request->file('image')!="")
            {
                if ($file = $request->file('image')) {
                    $name = 'user_'.time().$file->getClientOriginalName();
                    $file->move('images/users/', $name);
                    $input['image'] = $name;
                }
            }
            else
            {
                $input['image'] =$user['image'];
            }
            $input['password'] = bcrypt($input['password']);
            $user->update($input);
            return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
            ]);
        }
         catch(\Exception $e) 
        {
            return response()->json(['message'=>'حدث خطا أثناء محاولة تعديل المعلومات']);

        }
    }

}