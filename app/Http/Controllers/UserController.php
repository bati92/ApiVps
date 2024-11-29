<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vip;
use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    { 
        $users=DB::table('users')->select('*')->orderBy('id', 'desc')->paginate(500);
        $vips=DB::table('vips')->select('*')->orderBy('id', 'desc')->get();
        return view('backend.users.index', compact('users','vips'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if($request->file('image')!="")
        {
            if ($file = $request->file('image')) {
               $name = 'user'.time().$file->getClientOriginalName();
               $file->move('images/users/', $name);
               $input['image'] = $name;
            }
        }
        else
        {
            $input['image']="";
        }
        $input['mobile']= $input['code']. $input['mobile'];
        User::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');        
    }

    public function showCategory($id)
    {
        $users=DB::table('users')->select('*')->where('role',$id)->orderBy('id', 'desc')->paginate(500);
        $vips=DB::table('vips')->select('*')->orderBy('id', 'desc')->get();
        return view('backend.users.index',compact('users','vips'));
    }
    public function getAgents()
    {   $user=Auth::user();
        $users=DB::table('users')->select('*')->where('agent_id',$user->id)->orderBy('id', 'desc')->paginate(500);
        $vips=DB::table('vips')->select('*')->orderBy('id', 'desc')->get();
        return view('backend.users.index',compact('users','vips'));
    }
    public function addBalanceToAgent(Request $request)
    {   $user=Auth::user();
        $agent=User::find($request->agent_id);
        if( $user->role==1 || $request->value<=$user->balance)
        {
        $user->balance=$user->balance-$request->value;
        $user->save();
        $agent->balance=$agent->balance+$request->value;
        $agent->save();
        Transaction::create([
            'from_user_id' => $user->id,
            'to_user_id' =>$agent->id,
            'amount' => $agent->balance+$request->value,
            'payment_done'=>$request->payment_done
         
        ]);
        return back()->with('message', 'تم اضافة الرصيد بنجاح');
          }
           return back()->with('message', 'رصيدك غير كافي  ');
    }

    
    public function getUserTransactions($userId)
    {
        // الحصول على كافة العمليات المرتبطة بالمستخدم كمرسل
        $transactions = Transaction::where('from_user_id', $userId)
            ->with(['receiver', 'sender']) // جلب بيانات المرسل والمستلم
            ->get();
            return view('backend.users.transferRequest',compact('transactions'));
      
    }   

public function setPaymentDone($id)
{
    
    $transactions = Transaction::findOrFail($id);
    $transactions->payment_done=1;
    $transactions->save();

    return back()->with('message', 'تمت العملية بنجاح    ');
}
    public function update(Request $request,  $id)
    {
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
        
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy( $id)
    {
        $user= User::findOrFail($id);
        $user->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
