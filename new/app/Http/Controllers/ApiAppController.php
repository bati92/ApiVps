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
     
     }
       return response()->json(['apps'=>$apps ]);
    }
    public function show($id)
    {
       $app = App::findOrFail($id);
   //    $app->price=$this->getPrice($app);
       return response()->json(['app'=>$app ]);
    }
    
}
