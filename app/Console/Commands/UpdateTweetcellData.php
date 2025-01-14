<?php 

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tweetcell;
use App\Models\TweetcellSection;
use Http;

class UpdateTweetcellData extends Command
{
    protected $signature = 'tweetcell:update';
    protected $description = 'Fetch and update Tweetcell data from API';

    public function handle()
    {      TweetcellSection::query()->update(['status' => 0]);
        Tweetcell::query()->update(['status' => 0]);
        $apiUrl = 'https://bayi.tweetpin.net/servis/pin_listesi.php?kod=5534060015&sifre=cayli831';

        $response = Http::withOptions(['verify' => false])->get($apiUrl);

        if ($response->failed()) {
            $this->error('Failed to fetch data from the API.');
            return;
        }

        $games = $response->json()['result'];

        $newSectionsCount = 0;
        $newTweetcellsCount = 0;

        foreach ($games as $gameData) {
            $section = TweetcellSection::updateOrCreate(
                ['id' => $gameData['oyun_id']],
                [
                    'name' => $gameData['oyun_adi'],
                    'status' => 1,
                    'image' => null,
                    'image_url' => null,
                    'type' => 2,
                ]
            );

            if ($section->wasRecentlyCreated) {
                $newSectionsCount++;
            }

            $tweetcell = Tweetcell::where('name', $gameData['adi'])->where('section_id', $section->id)->first();

            $createdTweetcell = Tweetcell::updateOrCreate(
                ['name' => $gameData['adi'], 'section_id' => $section->id],
                [
                    'note' => $gameData['aciklama'],
                    'basic_price' => $gameData['fiyat'],
                    'price' => $tweetcell ? $tweetcell->price : 0,
                    'player_no'=> $gameData['oyun_bilgi_id'],
                    'amount' => $gameData['kupur'],
                    'status' => $tweetcell ? 1 : 0,
                    'image' => $tweetcell ? $tweetcell->image : null,
                    'image_url' => $tweetcell ? $tweetcell->image_url : null,
                ]
            );

            if ($createdTweetcell->wasRecentlyCreated) {
                $newTweetcellsCount++;
            }
        }

        $this->info("Tweetcell data updated successfully. New sections added: $newSectionsCount. New tweetcells added: $newTweetcellsCount.");
    }
}
