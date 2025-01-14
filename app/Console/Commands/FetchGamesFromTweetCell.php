<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use App\Models\App;
use App\Models\DataCommunication;
use App\Models\TweetcellKontor;
use Illuminate\Support\Facades\Http;

class FetchGamesFromTweetCell extends Command
{
  protected $signature = 'fetch:games';
    protected $description = 'Fetch games from the API and update prices in the database';

    public function handle()
    {
      
      TweetcellKontor::where('name', 'like', '%MTN%')
      ->update(['section_id' => 6]);
      TweetcellKontor::where('name', 'like', '%SyriaTel%')
      ->update(['section_id' =>5]);
      TweetcellKontor::where('name', 'like', '%Turkcell%')
      ->update(['section_id' =>2]);
       
      
      /*
        $apiUrl = 'https://1kanal.pro/b2c-api/market/getPackages?phone=0553%20406%2000%2015&password=zxc992299';

        // جلب البيانات من الـ API
        $response = Http::withOptions([
            'verify' => false,
        ])->get($apiUrl);

        if ($response->failed()) {
            $this->error('Failed to fetch data from the API.');
            return;
        }

        $services = $response->json()['packages'];

        foreach ($services as $s) {
  // التحقق من وجود GameSection أو إنشاؤه    

  $section = TweetcellKontor::updateOrCreate(
    [
        'name' => $s['name'],
        'code' => $s['code'],
        'basic_price' => $s['price'],
        'price' =>0,
        'status' => 1, // الحالة الافتراضية
        'type'=>0,  
        'section_id'=>4,]
);
             }*/
            }
}
