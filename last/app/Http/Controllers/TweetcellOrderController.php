<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TweetcellOrder;
use Illuminate\Support\Facades\DB;
use App\Models\Tweetcell;
class TweetcellOrderController extends Controller
{
    public function index($type)
    {   $currentUser = auth()->user();
        $orders = DB::table('tweetcell_orders')
        ->join('users', 'tweetcell_orders.user_id', '=', 'users.id')
        ->join('tweetcells', 'tweetcell_orders.tweetcell_id', '=', 'tweetcells.id')
        ->join('tweetcell_sections', 'tweetcells.section_id', '=','tweetcell_sections.id')
        ->where('tweetcell_sections.id', '=', $type) // إضافة شرط agent_id
        ->where('users.agent_id', '=', $currentUser->id) // إضافة شرط agent_id
        ->select('tweetcell_orders.*', 'users.name as user_name', 'tweetcells.name as service_name')
        ->get();
     
        return view('backend.tweetcell.tweetcellOrders.index', compact('orders'));
    }

}
