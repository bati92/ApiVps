<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppOrder;
use App\Models\App;
use App\Models\Vip;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Utils\ProfitCalculationService;
class ApiAppOrderController extends Controller
{  
     protected $profitService;

     public function __construct(ProfitCalculationService $profitService)
     {
         $this->profitService = $profitService;
     }

    public function store(Request $request)
    {      
        $input = $request->all(); 
          $user=Auth::user();
        $input['user_id']=$user->id;
        $order=AppOrder::create($input);
   
        $result=$this->operation($order, $input);
        return response()->json(['message'=>$result]);
    }
    public function operation($order, $input)
    {
        $user=Auth::user();
         

        if($user )
         {
            if($user->balance>=$order->price)
             { 
          $data = [
                  'kod' => "5534060015",
                  'sifre' => "cayli831",
                  'oyun' => $input['oyun_id'],
                  
                  'kupur' =>$input['count'],
                  'referans' =>$order->id,
                  'musteri_tel' => $user->mobile,
                  'oyuncu_bilgi' => $input['player_no'],
              ];     
              
      		//  $response = Http::get('https://bayi.tweetpin.net/servis/pin_ekle.php', $data);
                $response="OK|16|77";
              if (Str::startsWith($response, 'OK')) { 
                $user->balance=$user->balance-$order->price;
                $user->save();
                $order->status="مقبول ";
                $order->save();
          
                  $this->profitService->calculateProfit($order, App::class,$input['app_id']);
               

                   return "تمت عملية الشراء بنجاح  ";
              }  
              else {
                        return "   فشل عملية الشراء :خطا بالمعطيات  ";

              }

             }
          
             $order->status="مرفوض";
             $order->save();
             return "فشل عملية الشراء:الرصيد غير كافي   ";
         }
         return "فشل عملية الشراء   ";
    }
  
}
