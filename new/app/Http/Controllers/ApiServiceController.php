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
  
     }
       return response()->json(['services'=>$services ]);
    }
    public function show($id)
    {
       $service = Service::findOrFail($id);
       return response()->json(['service'=>$service ]);
    }
 
}
