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
use App\Models\Service;
use App\Models\User;
use App\Models\TransferMoneyFirm;
use App\Utils\ProfitCalculationService;

class AllServicesTotalController extends Controller
{ protected $profitService;
    public function __construct(ProfitCalculationService $profitService)
    {
        $this->profitService = $profitService;
    }

    public function index()
    {   
       $appRecords = App::count();
       $cardRecords = Card::count();
       $dataCommunicationRecords = DataCommunication::count();
       $ebankRecords = Ebank::count();
       $ecardRecords = Ecard::count();
       $gameRecords = Game::count();
       $serviceRecords = Service::count();
       $programRecords = Program::count();
       $users = User::where('agent_id',auth()->user()->id)->count();
       $transferMoneyFirmRecords = TransferMoneyFirm::count();
       $balance=auth()->user()->balance;
       $financials = $this->profitService->calculateUserFinancials( auth()->user()->id); 
      
       return view('backend.dashboard',compact( 'appRecords',
       'cardRecords',
       'dataCommunicationRecords',
       'ebankRecords',
       'serviceRecords',
       'ecardRecords',
       'gameRecords',
       'balance',
       'programRecords',
       'transferMoneyFirmRecords',
    'users','financials'));

  
    }

}
