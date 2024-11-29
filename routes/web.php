<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AppSectionContoller;
use App\Http\Controllers\AppOrderController;
use App\Http\Controllers\AllServicesTotalController;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;

use App\Http\Controllers\CardController;
use App\Http\Controllers\CardOrderController;

use App\Http\Controllers\DataCommunicationController;
use App\Http\Controllers\DataCommunicationSectionController;
use App\Http\Controllers\DataCommunicationOrderController;

use App\Http\Controllers\EbankController;
use App\Http\Controllers\EbankSectionController;
use App\Http\Controllers\EbankOrderController;
use App\Http\Controllers\EcardSectionController;
use App\Http\Controllers\EcardOrderController;
use App\Http\Controllers\EcardController;

use App\Http\Controllers\GameController;
use App\Http\Controllers\GameSectionController;
use App\Http\Controllers\GameOrderController;

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramOrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TransferOrderController;

use App\Http\Controllers\TransferMoneyFirmController;
use App\Http\Controllers\TransferMoneyFirmOrderController;

use App\Http\Controllers\TurkificationOrderController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\User;

use App\Http\Controllers\VipController;
use App\Models\Setting;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\FavoriteController;

use App\Http\Middleware\LoadSettings;
use App\Mail\EbankEmail;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Mail;

Route::get('/favorites', [FavoriteController::class, 'getUserFavorites']);

    Route::get('/ss',function(){
Mail::raw('This is a test email using MailerSender', function ($message) {
    $message->to('info.eng.123@gmail.com')
            ->subject('Test MailerSender Email');
});
      });

Route::middleware([LoadSettings::class])->group(function () {


Route::group(['middleware'=> 'auth'], function(){

 

    Route::get('/admin/unread-notifications', [NotificationController::class, 'getUnreadNotifications'])->name('unread.notifications');
    Route::get('/dashboard', [AllServicesTotalController::class, 'index']);
    
    Route::get('/', [AllServicesTotalController::class, 'index']);
    Route::get('/home', [AllServicesTotalController::class, 'index']);
    Route::resource( 'user', UserController::class,);
    
    Route::get('users/{id}/category', [UserController::class, 'showCategory']);
    
    Route::post('users/balance', [UserController::class, 'addBalanceToAgent'])->name('users.balance');
    
    Route::get('users/agents', [UserController::class, 'getAgents']);
    
    Route::get('users/transactions/{id}', [UserController::class, 'getUserTransactions']);
    
    Route::get('users/transactions/done/{id}', [UserController::class, 'setPaymentDone']);
    Route::get('/profile', function () {  return view('backend.users.profile');});
 
    Route::resource('setting', SettingController::class);
    
    Route::resource('service-category', ServiceCategoryController::class);
    
    Route::post('/service-category/{id}/status',[ ServiceCategoryController::class,'changeStatus']);
    
    Route::get('/service-category/{id}/category',[ ServiceController::class,'showServices']);

    Route::resource('service', ServiceController::class);
    
    Route::post('/service/{id}/status',[ ServiceController::class,'changeStatus']);
    Route::resource('myapp', AppController::class);
    Route::resource('app-section', AppSectionContoller::class);
    Route::resource('app-order', AppOrderController::class);
    Route::get('app-order/reject/{id}',[ AppOrderController::class,'reject']);
    Route::get('app-order/accept/{id}',[ AppOrderController::class,'accept']);

    Route::get('/app/{id}/category',[ AppController::class,'showApps']);
    Route::post('/app/{id}/status',[ AppController::class,'changeStatus']);
    Route::post('/app-section/{id}/status',[ AppSectionContoller::class,'changeStatus']);
    
    Route::resource('card' , CardController::class);
    Route::post('/card/{id}/status' , [CardController::class,'changeStatus']);
    Route::resource('card-order' , CardOrderController::class);
    
    Route::get('card-order/reject/{id}',[ CardOrderController::class,'reject']);
    Route::get('card-order/accept/{id}',[ CardOrderController::class,'accept']);
    
    Route::resource('data-communication' , DataCommunicationController::class);
    Route::resource('data-communication-section' , DataCommunicationSectionController::class);
    Route::get('/data-communication/{id}/category'  ,[ DataCommunicationController::class,'showData']);
    Route::resource('data-communication-order' , DataCommunicationOrderController::class);
    Route::post('/data-communication/{id}/status',[ DataCommunicationController::class,'changeStatus']);
    
    Route::get('data-communication-order/reject/{id}',[ DataCommunicationOrderController::class,'reject']);
    Route::get('data-communication-order/accept/{id}',[ DataCommunicationOrderController::class,'accept']);


    Route::resource('ebank' , EbankController::class);
    Route::resource('ebank-section' , EbankSectionController::class);
    Route::get('/ebank/{id}/category',[ EbankController::class,'showEbanks']);
    Route::resource('ebank-order' , EbankOrderController::class);
    Route::post('/ebank/{id}/status',[ EbankController::class,'changeStatus']);
    Route::post('/ebank-section/{id}/status',[ EbankSectionController::class,'changeStatus']);    
    Route::get('ebank-order/reject/{id}',[ EbankOrderController::class,'reject']);
    Route::get('ebank-order/accept/{id}',[ EbankOrderController::class,'accept']);


    Route::resource('ecard' , EcardController::class);
    Route::resource('ecard-section' , EcardSectionController::class);
    Route::get('/ecard/{id}/category',[ EcardController::class,'showEcards']);
    Route::resource('ecard-order' , EcardOrderController::class);
    Route::post('/ecard-section/{id}/status',[ EcardSectionController::class,'changeStatus']);
    Route::post('/ecard/{id}/status',[ EcardController::class,'changeStatus']);
    Route::get('ecard-order/reject/{id}',[ EcardOrderController::class,'reject']);
    Route::get('ecard-order/accept/{id}',[ EcardOrderController::class,'accept']);

    Route::resource('game' , GameController::class);
    Route::resource('game-section' , GameSectionController::class);
    Route::get('/game/{id}/category',[ GameController::class,'showGames']);
    Route::resource('game-order' , GameOrderController::class);
    Route::post('/game-section/{id}/status',[ GameSectionController::class,'changeStatus']);
    Route::post('/game/{id}/status',[ GameController::class,'changeStatus']);

    Route::get('game-order/reject/{id}',[ GameOrderController::class,'reject']);
    Route::get('game-order/accept/{id}',[ GameOrderController::class,'accept']);

    
    Route::resource('program' , ProgramController::class);
    Route::post('/program/{id}/status',[ProgramController::class,'changeStatus']);
    Route::resource('program-order' , ProgramOrderController::class);
    
    Route::get('program-order/reject/{id}',[ ProgramOrderController::class,'reject']);
    Route::get('program-order/accept/{id}',[ ProgramOrderController::class,'accept']);

    Route::resource('slider', SliderController::class);

    Route::resource('transfer-money-firm' , TransferMoneyFirmController::class);
    Route::post('/transfer-money-firm/{id}/status',[TransferMoneyFirmController::class,'changeStatus']);
    Route::resource('transfer-money-firm-order' , TransferMoneyFirmOrderController::class);
    
    Route::get('transfer-money-firm-order/reject/{id}',[ TransferMoneyFirmOrderController::class,'reject']);
    Route::get('transfer-money-firm-order/accept/{id}',[ TransferMoneyFirmOrderController::class,'accept']);

    Route::resource('transfer-order' , TransferOrderController::class);
    
    Route::get('transfer-order/reject/{id}',[ TransferOrderController::class,'reject']);
    Route::get('transfer-order/accept/{id}',[ TransferOrderController::class,'accept']);
    
    Route::resource('turkification-order' , TurkificationOrderController::class);
    
    Route::get('turkification-order/reject/{id}',[ TurkificationOrderController::class,'reject']);
    Route::get('turkification-order/accept/{id}',[ TurkificationOrderController::class,'accept']);
    
    Route::resource('vip', VipController::class,);
    

}); 

}); 
Auth::routes();