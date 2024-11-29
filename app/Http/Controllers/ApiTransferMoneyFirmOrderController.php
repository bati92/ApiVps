<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\TransferMoneyFirmOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApiTransferMoneyFirmOrderController extends Controller
{
    


    public function store(Request $request)
    {  
        $input = $request->all();
       
        TransferMoneyFirmOrder::create($input);
        
    return response()->json(['message' => '  جاري العمل على طلبك']);
        
    }
    public function myPayments($id)
    {
    
       
      
   $transferMoneyOrders= $orders = DB::table('transfer_money_firm_orders')
    ->join('transfer_money_firms', 'transfer_money_firm_orders.transfer_money_firm_id', '=', 'transfer_money_firms.id')
    ->join('users', 'transfer_money_firm_orders.user_id', '=', 'users.id')
    ->select(
        'transfer_money_firm_orders.id as order_id',
        'transfer_money_firm_orders.sender',
        'transfer_money_firm_orders.value',
        'transfer_money_firm_orders.currency',
      'transfer_money_firm_orders.created_at',
      'transfer_money_firm_orders.status',
        'transfer_money_firms.name as firm_name',
        'users.name as user_name'
    )
    ->where('users.id', $id)
    ->get();
    
        return response()->json(['orders' => $transferMoneyOrders]);
    
       
    }


}
