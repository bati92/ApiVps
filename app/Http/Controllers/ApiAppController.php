<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\DB;
use App\Models\Vip;

class ApiAppController extends Controller
{
    public function index()
    {
       $apps=DB::table('apps')->select('*')->orderBy('id', 'desc')->paginate(500);
      // response()->json(['apps'=>auth()->user() ]);
       foreach ($apps as $app) {
         $app->image_url = asset('assets/images/apps/' . $app->image);  // إنشاء رابط للصورة
        // $app->save();
       //  $app->price=$this->getPrice($app);
     }
       return response()->json(['apps'=>$apps ]);
    }
    public function show($id)
    {
       $app = App::findOrFail($id);
   //    $app->price=$this->getPrice($app);
       return response()->json(['app'=>$app ]);
    }
    public function getPrice($service)
    {  
        $user = auth()->user();
        if (!$user) {
            return $service->price;  
          }
        
        $vip=Vip::where('id',$user->vip_id)->first();
        if ($user->role == 2|| $user->role == 3)  {
            return $service->price=$app->price - $service->price*$vip->commession_percent/100; 
        }
        
        return $service->price;
    }
}
