<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GameSection;

class ApiGameSectionController extends Controller
{
    public function index()
    {
       $gameSections=DB::table('game_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
       foreach ($gameSections as $app) {
         $app->image_url = asset('assets/images/gameSections/' . $app->image);  // إنشاء رابط للصورة
     
        }
       return response()->json(['gameSections'=> $gameSections ]);
    }

    public function getGames(string $section_id)
    {
       $section = GameSection::find($section_id);
       $games = $section->games;
       foreach ($games as $app) {
         $app->image_url = asset('assets/images/games/' . $app->image);  // إنشاء رابط للصورة
         $app->save();
        }
       return response()->json(['games'=> $games ]);
    }
}
