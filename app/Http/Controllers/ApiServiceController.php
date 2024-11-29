<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Vip;

class ApiServiceController extends Controller
{

    public function index()
    {
       $services=Service::all();
       foreach ($services as $s) {
         $s->image_url = asset('assets/images/service/' . $s->image);  // إنشاء رابط للصورة
  
         $s->price=$this->getPrice($s);
     }
       return response()->json(['services'=>$services ]);
    }
    public function show($id)
    {
       $service = Service::findOrFail($id);
       $service->price=$this->getPrice($service);
       return response()->json(['service'=>$service ]);
    }
    public function getPrice($service)
    {  
        $user = auth()->user();
        if (!$user) {
            return $service->price;  
          }
        
        $vip=Vip::where('id',$user->vip_id)->first();
        if ($user->role == 2|| $user->role == 3)  {
            return $service->price=$service->price - $service->price*$vip->commession_percent/100; 
        }
        
        return $service->price;
    }
}
