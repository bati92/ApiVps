<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Game;

class ApiGameController extends Controller
{
    public function index()
    {
       $games=DB::table('games')->select('*')->orderBy('id', 'desc')->paginate(500);
       foreach ($games as $app) {
         $app->image_url = asset('assets/images/games/' . $trans->image);  // إنشاء رابط للصورة
       
      }
       return response()->json(['games'=>$games ]);
    }
    public function show($id)
    {
       $game = Game::findOrFail($id);
       return response()->json(['game'=>$game ]);
    }
}
