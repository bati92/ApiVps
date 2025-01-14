<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataCommunicationOrder;
use App\Models\DataCommunication;
use App\Models\Vip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Utils\ProfitCalculationService;
class ApiDataCommunicationOrderController extends Controller
{protected $profitService;

    public function __construct(ProfitCalculationService $profitService)
    {
        $this->profitService = $profitService;
    }
    public function store(Request $request)
    {  
       
        $input = $request->all();
        if(!$input['user_id'])
        {
            $input['user_id']=Auth::user()->id;

        }
       $order= DataCommunicationOrder::create($input);
        $result=$this->operation($order);
        return response()->json(['message'=>$result]);
    }

    public function operation($order)
    {
        $user=Auth::user();
        if($user )
         {
            if($user->balance>=$order->price)
             {
                $user->balance=$user->balance-$order->price;
                $user->save();
                $order->status="قيد المراجعة";
                $order->save();
         
               // $this->profitService->calculateProfit($order, DataCommunication::class);
                return "تم تسجيل طلبك  ";

             }
             $order->status="مرفوض";
             $order->save();
             return "فشل عملية الشراء:الرصيد غير كافي   ";
         }
         return "فشل عملية الشراء:الرصيد غير كافي   ";
    }
    
  
}
