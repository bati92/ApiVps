<?php

namespace App\Utils;

use App\Models\Vip;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Profit;

class ProfitCalculationService
{ 
  public function calculateProfit($order, $modelType,$serviceId)
  {
      $calculatedProfit = 0;

      // الحصول على المستخدم الحالي
      $user = auth()->user();
      $agent = User::find($user->agent_id);

      if (!$agent) {
          return null; // إذا لم يكن هناك وكيل مرتبط
      }

      $vip = Vip::where('id', $agent->vip_id)->first();

      // التأكد من صلاحية الدور
      if ($agent->role == 2 || $agent->role == 3) {
          $service = $modelType::findOrFail($serviceId); // جلب الخدمة
          $calculatedProfit = $service->price * ($vip->commession_percent / 100);

          // تسجيل الربح
          $order->profits()->create([
              'user_id' => $agent->id,
              'profit_amount' => $calculatedProfit,
          ]);
      }
      else if($agent->role==1)
      {  $service = $modelType::findOrFail($serviceId); // جلب الخدمة
        $calculatedProfit =$service->price -$service->basic_price  ;
          // تسجيل الربح
          $order->profits()->create([
            'user_id' => $agent->id,
            'profit_amount' => $calculatedProfit,
        ]);
      }

      return $calculatedProfit;
  }


    public function getPrice($service)
    {
        $user = auth()->user();
        if (!$user) {
            return $service->price;  
        }

        $vip = Vip::where('id', $user->vip_id)->first();
        if ($user->role == 2 || $user->role == 3) {
            return $service->price - ($service->price * $vip->commession_percent / 100); 
        }

        return $service->price;
    }
    public function calculateUserFinancials($userId)
    {
        $balance=User::find($userId)->balance;
        // الوارد
        $incoming = Transaction::where('to_user_id', $userId)
                                ->where('payment_done', 1)
                                ->sum('amount');
    
        // الصادر
        $outgoing = Transaction::where('from_user_id', $userId)
                                ->where('payment_done', 1)
                                ->sum('amount');
    
        // الأرباح
        $profits = Profit::where('user_id', $userId)->sum('profit_amount');
    
        // الديون
        $debts = Transaction::where('to_user_id', $userId)
                            ->where('payment_done', 0)
                            ->sum('amount');
    
        return [
            'incoming' => $incoming,
            'outgoing' => $outgoing,
            'profits'  => $profits,
            'debts'    => $debts,
            'balance'=>$balance,
        ];
    }
    

}