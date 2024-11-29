<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceCategories;
use App\Models\Service;
use App\Models\Vip;

class ApiServiceCategoryController extends Controller
{
    public function index()
    {
       $categories=DB::table('service_categories')->select('*')->orderBy('id', 'desc')->paginate(500);

       foreach ($categories as $app) {
         $app->image_url = asset('assets/images/service/' . $app->image);  // إنشاء رابط للصورة
     }
     
       return response()->json(['categories'=> $categories ]);
    }

    public function getServices (string $section_id)
    {
       $cat = ServiceCategories::find($section_id);
       $services = $cat->services;
       foreach ($services as $app) {
         $app->image_url = asset('assets/images/service/' . $app->image);  // إنشاء رابط للصورة
           // $app->price=$this->getPrice($app);
     }
       return response()->json(['services'=> $services ]);
    }

  
}
