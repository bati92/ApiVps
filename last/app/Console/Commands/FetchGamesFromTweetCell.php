<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use App\Models\App;
use App\Models\DataCommunication;

use App\Models\Tweetcell;

use Illuminate\Support\Facades\Http;

class FetchGamesFromTweetCell extends Command
{
  protected $signature = 'fetch:games';
    protected $description = 'Fetch games from the API and update prices in the database';

    public function handle()
    {
        $tweetcellSections = Tweetcell::all();

    foreach ($tweetcellSections as $tweetcell) {
        // البحث عن قسم في جدول الألعاب بنفس الاسم
        $gameSection = Game::where('amount', $tweetcell->amount)->where('user_id_game', $tweetcell->player_no)->first();

        // إذا وجد قسم مطابق، تحديث الصورة
        if ($gameSection && $gameSection->image) {
            $tweetcell->update([
                'image' => $gameSection->image,
                'image_url' => $gameSection->image_url
            ]);
        }
        
    }
    foreach ($tweetcellSections as $tweetcell) {
        // البحث عن قسم في جدول الألعاب بنفس الاسم
        $gameSection = App::where('amount', $tweetcell->amount)->where('player_no', $tweetcell->player_no)->first();

        // إذا وجد قسم مطابق، تحديث الصورة
        if ($gameSection && $gameSection->image) {
            $tweetcell->update([
                'image' => $gameSection->image,
                'image_url' => $gameSection->image_url
            ]);
        }
        
    }
    foreach ($tweetcellSections as $tweetcell) {
        // البحث عن قسم في جدول الألعاب بنفس الاسم
        $gameSection = DataCommunication::where('amount', $tweetcell->amount)->where('player_no', $tweetcell->player_no)->first();

        // إذا وجد قسم مطابق، تحديث الصورة
        if ($gameSection && $gameSection->image) {
            $tweetcell->update([
                'image' => $gameSection->image,
                'image_url' => $gameSection->image_url
            ]);
        }
        
    }

    return "Images updated successfully!";
      

    }
}
