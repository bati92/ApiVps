<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TweetcellSection;
use App\Models\Tweetcell;

class ApiGameSectionController extends Controller
{
    public function index()
    {
       $gameSections=DB::table('tweetcell_sections')->where('type',1)->select('*')->orderBy('id', 'desc')->paginate(500);
       foreach ($gameSections as $app) {
         $app->image_url = asset('assets/images/tweetcellSections/'.$app->image);  // إنشاء رابط للصورة
     
        }
       return response()->json(['gameSections'=> $gameSections ]);
    }

    public function getGames(string $section_id)
    {
       $section = TweetcellSection::find($section_id);
       $games = $section->tweetcells;
       foreach ($games as $app) {
         $app->image_url = asset('assets/images/tweetcellSections/'.$app->image);  // إنشاء رابط للصورة
         $app->save();
        }
       return response()->json(['games'=> $games ]);
    }
}
