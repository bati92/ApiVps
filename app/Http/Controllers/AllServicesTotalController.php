<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\App;
use App\Models\Card;
use App\Models\DataCommunication;
use App\Models\Ebank;
use App\Models\Ecard;
use App\Models\Game;
use App\Models\Program;
use App\Models\User;
use App\Models\TransferMoneyFirm;

class AllServicesTotalController extends Controller
{
    public function index()
    {   
       $appRecords = App::count();
       $cardRecords = Card::count();
       $dataCommunicationRecords = DataCommunication::count();
       $ebankRecords = Ebank::count();
       $ecardRecords = Ecard::count();
       $gameRecords = Game::count();
       $programRecords = Program::count();
       $users = User::count();
       $transferMoneyFirmRecords = TransferMoneyFirm::count();
       return view('backend.dashboard',compact( 'appRecords',
       'cardRecords',
       'dataCommunicationRecords',
       'ebankRecords',
       'ecardRecords',
       'gameRecords',
       'programRecords',
       'transferMoneyFirmRecords',
    'users',));
  
    }
}
