<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\Service;
use App\Models\Vip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\ProfitCalculationService;
class ApiServiceOrderController extends Controller
{   protected $profitService;

    public function __construct(ProfitCalculationService $profitService)
    {
        $this->profitService = $profitService;
    } 
    public function store(Request $request)
    {  
        $input = $request->all();
        $order=ServiceOrder::create($input);
  
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
                $order->status="مقبول";
                $order->save();
            
                $this->profitService->calculateProfit($order, Service::class);
                return "تمت عملية الشراء بنجاح";

             }
             $order->status="مرفوض";
             $order->save();
             return "فشل عملية الشراء:الرصيد غير كافي   ";
         }
         return "فشل عملية الشراء:الرصيد غير كافي   ";
    }


  /*  public function calculateProfit($order)
    { $calculatedProfit=0;
       $user=Auth::user();
       $service=Service::findOrFail($order->service_id);
       $agent=User::find($user->agent_id);
       $vip=Vip::where('id',$agent->vip_id)->first();
       if ($agent->role == 2|| $agent->role == 3)  {
           $calculatedProfit=$service->price*$vip->commession_percent/100; 
       
       $order1 = ServiceOrder::find($order->id); // الحصول على الطلب من نموذج Program
          $order1->profits()->create([
              'user_id' => $agent->id,
              'profit_amount' => $calculatedProfit,
          ]);
        }
    }*/
}
