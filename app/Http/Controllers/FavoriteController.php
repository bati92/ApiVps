<?php

// app/Http/Controllers/FavoriteController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Favorite;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string|in:App,Ecard,Card,Ebank,DataCommunication,Game,Service,Program',
        ]);
        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'item_type' => $request->item_type,
        ]);

        return response()->json(['message' => 'Added to favorites', 'favorite' => $favorite]);
    }

    public function removeFavorite(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string|in:App,Ecard,Card,Ebank,DataCommunication,Game,Service,Program',
        ]);

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('item_id', $request->item_id)
            ->where('item_type', $request->item_type)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Removed from favorites']);
        }

        return response()->json(['message' => 'Favorite not found'], 404);
    }



public function getUserFavorites()
{  $tableMapping = [
    'App' => 'apps',
    'Game' => 'games',
    'DataCommunication' => 'data_communications',
    'Program' => 'programs',
    'Ecard' => 'ecards',
    'Card' => 'cards',
    'Ebank' => 'ebanks',
     'Service'=>'services'
];
$slugTable = [
    'App' => 'app',
    'Game' => 'game',
    'DataCommunication' => 'data-communication',
    'Program' => 'program',
    'Ecard' => 'ecard',
    'Card' => 'card',
    'Ebank' => 'ebank',
  'Service'=>'service'
];

$favorites = Auth::user()->favorites()->get();
$results = [];

foreach ($favorites as $favorite) {
    // الحصول على اسم الجدول من الخريطة بناءً على `item_type`
    $table = $tableMapping[$favorite->item_type] ?? null;
    
    $slug = $slugTable[$favorite->item_type] ?? null;

    // التأكد من أن اسم الجدول موجود في الخريطة
    if ($table) {
        $query = "SELECT id, name, image_url, price, status,section_id FROM {$table} WHERE id = :item_id LIMIT 1";
        
        // تنفيذ الاستعلام
        $item = DB::select($query, ['item_id' => $favorite->item_id]);
        
        if (!empty($item)) {
            $results[] = [
                'id' => $item[0]->id,
                'section_id' => $item[0]->section_id ,
                'name' => $item[0]->name,
                'image_url' => $item[0]->image_url,
                'price' => $item[0]->price,
                'status' => $item[0]->status,
                'slug' => $slug,
            ];
        }
    }
}


    return response()->json(['favorites' => $results]);
}

    

    public function isFavorite(Request $request)
{
    $request->validate([
        'item_id' => 'required|integer',
        'item_type' => 'required|string|in:App,Ecard,Card,Ebank,DataCommunication,Service,Game,Program',
    ]);

    $favoriteExists = Favorite::where('user_id', Auth::id())
        ->where('item_id', $request->item_id)
        ->where('item_type', $request->item_type)
        ->exists();

    return response()->json(['is_favorite' => $favoriteExists]);
}
}

