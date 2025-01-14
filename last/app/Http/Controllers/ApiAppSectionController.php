<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TweetcellSection;
use App\Models\Tweetcell;

class ApiAppSectionController extends Controller
{
    public function index()
    {
       $appSections=DB::table('tweetcell_sections')->where('type',2)->select('*')->orderBy('id', 'desc')->paginate(500);

       foreach ($appSections as $app) {
         $app->image_url = asset('assets/images/tweetcellSections/' . $app->image);  // إنشاء رابط للصورة
     }
     
       return response()->json(['appSections'=> $appSections ]);
    }

    public function getApps(string $section_id)
    {
       $section = TweetcellSection::find($section_id);
       $apps = $section->tweetcells;
       foreach ($apps as $app) {
         $app->image_url = asset('assets/images/tweetcellSections/' . $app->image);  // إنشاء رابط للصورة
            $app->save();
     }
       return response()->json(['apps'=> $apps ]);
    }
}
