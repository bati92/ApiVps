<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use App\Models\GameSection;
use Illuminate\Support\Facades\Http;

class FetchGamesFromTweetCell extends Command
{
    protected $signature = 'fetch:games';
    protected $description = 'Fetch games from the API and store them in the database';

    public function handle()
    {
        $apiUrl = 'https://bayi.tweetpin.net/servis/pin_listesi.php?kod=5534060015&sifre=cayli831';

        // جلب البيانات من الـ API
        $response = Http::withOptions([
            'verify' => false,
        ])->get($apiUrl);

        if ($response->failed()) {
            $this->error('Failed to fetch data from the API.');
            return;
        }

        $games = $response->json()['result'];

        foreach ($games as $gameData) {
            // التحقق من وجود GameSection أو إنشاؤه
            $section = GameSection::updateOrCreate(
                ['id' => $gameData['oyun_id']], // الشرط: استخدام ID الخاص بالقسم
                [
                    'name' => $gameData['oyun_adi'],
                    'status' => 1, // الحالة الافتراضية
                    'image' => null,
                    'image_url' => null,
                ]
            );

            // التحقق من وجود Game أو إنشاؤه
            Game::updateOrCreate(
                ['name' => $gameData['adi'], 'section_id' => $section->id], // الشرط: التحقق باستخدام الاسم والقسم
                [
                    'note' => $gameData['aciklama'],
                    'basic_price' => $gameData['fiyat'],
                    'price' => 0,
                    'user_id_game'=> $gameData['oyun_bilgi_id'],
                    'amount' => $gameData['kupur'],
                    'status' => 1, // الحالة الافتراضية
                    'image' => null,
                    'image_url' => null,
                ]
            );
        }

        $this->info('Games data fetched and stored successfully.');
    }
}
