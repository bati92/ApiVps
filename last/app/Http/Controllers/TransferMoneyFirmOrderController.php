<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\TransferMoneyFirmOrder;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;

class TransferMoneyFirmOrderController extends Controller
{
    public function index()
    {
          // التحقق من تسجيل المستخدم
    $currentAgentId = auth()->user()->id;

    // جلب الطلبات مع التحقق من أن agent_id يطابق المستخدم الحالي
    $transferMoneyFirmOrders = DB::table('transfer_money_firm_orders')
        ->join('users', 'transfer_money_firm_orders.user_id', '=', 'users.id')
        ->join('transfer_money_firms', 'transfer_money_firm_orders.transfer_money_firm_id', '=', 'transfer_money_firms.id')
        ->where('users.agent_id', $currentAgentId) // إضافة شرط agent_id
        ->select('transfer_money_firm_orders.*', 'users.name as user_name', 'transfer_money_firms.name as transfer_money_firm_name')
        ->orderBy('transfer_money_firm_orders.id', 'desc') // ترتيب النتائج
        ->paginate(500); // استخدام التصفح

        return view('backend.transferMoneyFirm.transferMoneyFirmOrders.index', compact('transferMoneyFirmOrders'));
    }

      

    public function reject( $id)
    {   $agent=Auth::user();
        $order= TransferMoneyFirmOrder::findOrFail($id);
        $customer=User::where('id',$order->user_id)->first();
        if($agent->balance>=$order->value)
       { $customer->balance+=$order->value;
        $customer->save();
        $agent->balance-=$order->value;
        $agent->save();
        $order->status="دين";
        $order->save();
       Transaction::create([
            'from_user_id' => $agent->id,
            'to_user_id' =>$customer->id,
            'order_id'=> $order->id,
            'amount' => $order->value,
            'payment_done'=>0
        
        ]);
   
        return back()->with('message', 'تمت العملية  بنجاح');
    }
    return back()->with('message', 'الرصيد غير كافي   ');
    }
    public function accept( $id)
    {    
        $agent=Auth::user();
        $order= TransferMoneyFirmOrder::findOrFail($id);
        $customer=User::where('id',$order->user_id)->first();
        if($agent->balance>=$order->value)
       { $customer->balance+=$order->value;
        $customer->save();
        $agent->balance-=$order->value;
        $agent->save();
        $order->status="مقبول";
        $order->save();
       Transaction::create([
            'from_user_id' => $agent->id,
            'to_user_id' =>$customer->id,
            'amount' => $order->value,
          'order_id'=> $order->id,
            'payment_done'=>1
        
        ]);
   
        return back()->with('message', 'تمت العملية  بنجاح');
    }
    return back()->with('message', 'الرصيد غير كافي   ');
   }
    public function store(Request $request)
    {
        $input = $request->all();
       
        TransferMoneyFirmOrder::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    public function show( $id)
    {
    }

    public function edit( $id)
    {
    }

    public function update(Request $request,  $id)
    {
        $transferMoneyFirmOrder = TransferMoneyFirmOrder::findOrFail($id);
        $input = $request->all();
        
        $transferMoneyFirmOrder->update( $input);
        
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy( $id)
    {
        $transferMoneyFirmOrder= TransferMoneyFirmOrder::findOrFail($id);
        $transferMoneyFirmOrder->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
