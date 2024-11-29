<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AppSection;
use App\Models\App;

class ApiAppSectionController extends Controller
{
    public function index()
    {
       $appSections=DB::table('app_sections')->select('*')->orderBy('id', 'desc')->paginate(500);

       foreach ($appSections as $app) {
         $app->image_url = asset('assets/images/appSections/' . $app->image);  // إنشاء رابط للصورة
     }
     
       return response()->json(['appSections'=> $appSections ]);
    }

    public function getApps(string $section_id)
    {
       $section = AppSection::find($section_id);
       $apps = $section->apps;
       foreach ($apps as $app) {
         $app->image_url = asset('assets/images/apps/' . $app->image);  // إنشاء رابط للصورة
            $app->save();
     }
       return response()->json(['apps'=> $apps ]);
    }
}
