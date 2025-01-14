<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAllServicesTotalController;
use App\Http\Controllers\ApiAppController;
use App\Http\Controllers\ApiAppSectionController;
use App\Http\Controllers\ApiEbankSectionController;
use App\Http\Controllers\ApiCardController;
use App\Http\Controllers\ApiDataCommunicationController;
use App\Http\Controllers\ApiEbankController;
use App\Http\Controllers\ApiEcardController;
use App\Http\Controllers\ApiProgramController;
use App\Http\Controllers\ApiTransferMoneyFirmController;
use App\Http\Controllers\ApiTransferMoneyFirmOrderController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiEcardSectionController;
use App\Http\Controllers\ApiGameController;
use App\Http\Controllers\ApiGameOrderController;
use App\Http\Controllers\ApiGameSectionController;
use App\Http\Controllers\ApiSettingController;
use App\Http\Controllers\ApiCardOrderController;
use App\Http\Controllers\ApiECardOrderController;
use App\Http\Controllers\ApiTweetcellOrderController;
use App\Http\Controllers\ApiDataCommunicationSectionController;
use App\Http\Controllers\ApiTransferController;

use App\Http\Controllers\ApiEBankOrderController;
use App\Http\Controllers\ApiProgramOrderController;
use App\Http\Controllers\ApiTurkificationOrderController;
use App\Http\Controllers\ApiSliderController;
use App\Http\Controllers\ApiTransferOrderController;


use App\Http\Controllers\ApiServiceCategoryController;

use App\Http\Controllers\ApiServiceController;

use App\Http\Controllers\ServiceOrderController;

use App\Http\Controllers\ApiServiceOrderController;

use App\Http\Controllers\FavoriteController;



Route::get('game/test',[ApiGameOrderController::class, 'test']);

Route::post('register',[ApiUserController::class, 'store']);
Route::post('register/{info}',[ApiUserController::class, 'storeAgent']);


Route::post('login',[ApiUserController::class, 'login']);
Route::get('/auth-check',[ApiUserController::class, 'authCheck']);

Route::post('/verifyOtpLogin', [ApiUserController::class, 'verifyOtpLogin']);
Route::post('/forgot-password', [ApiUserController::class, 'forgotPassword']);



Route::get('slider', [ApiSliderController::class, 'index']);
Route::get('totalRecords',[ApiAllServicesTotalController::class, 'index']);

Route::get('about-us', [ApiSettingController::class, 'index']);

Route::get('transfer-money-firms', [ApiTransferMoneyFirmController::class, 'index']);
Route::get('transfer-money-firm/{id}', [ApiTransferMoneyFirmController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    
Route::post('/favorites/add', [FavoriteController::class, 'addFavorite']);
Route::post('/favorites/remove', [FavoriteController::class, 'removeFavorite']);
Route::get('/favorites', [FavoriteController::class, 'getUserFavorites']);

Route::post('/is-favorite', [FavoriteController::class, 'isFavorite']);


Route::post('service/order/{id}',[ApiServiceOrderController::class, 'store']);

  


Route::post('card/order/{id}',[ApiCardOrderController::class, 'store']);

Route::post('ecard/order/{id}',[ApiECardOrderController::class, 'store']);
Route::post('tweetcell/order/{id}',[ApiTweetcellOrderController::class, 'store']);
Route::post('ebank/order/{id}',[ApiEBankOrderController::class, 'store']);

Route::post('turkification/order',[ApiTurkificationOrderController::class, 'store']);

Route::post('program/order/{id}',[ApiProgramOrderController::class, 'store']);

Route::post('transfer/order',[ApiTransferOrderController::class, 'store']);





    Route::get('logged-in-user', [ApiUserController::class, 'getLoggedInUser']);
    Route::get('logout', [ApiUserController::class, 'logout']);
    Route::patch('users/{id}', [ApiUserController::class, 'update']);
    Route::get('/agents', [ApiUserController::class, 'getAgents']);    
  Route::post('/verifyOtp', [ApiUserController::class, 'verifyOtp']);


Route::get('/twoFactorStatus', [ApiUserController::class, 'status']);
Route::post('/enableTwoFactor', [ApiUserController::class, 'enable']);

Route::post('/verifyOtp', [ApiUserController::class, 'verifyOtp']);
Route::get('/qrCreate', [ApiUserController::class, 'qrCreate']);
    Route::post('charge', [ApiTransferMoneyFirmOrderController::class, 'store']);
    

    Route::get('myPayments/{id}', [ApiTransferMoneyFirmOrderController::class, 'myPayments']);

Route::get('myRequests/{id}', [ApiUserController::class, 'myRequests']);
Route::get('myWallet', [ApiAllServicesTotalController::class, 'myWallet']);

});

Route::get('getservices', [ApiAllServicesTotalController::class, 'getServiceList']);



Route::get('programs', [ApiProgramController::class, 'index']);
Route::get('program/{id}', [ApiProgramController::class, 'show']);




Route::get('transfer', [ApiTransferController::class, 'index']);

Route::get('service-sections',[ApiServiceCategoryController::class, 'index']);
Route::get('service-sections/{id}',[ApiServiceCategoryController::class, 'getServices']);
Route::get('service/{id}',[ApiServiceController::class, 'show']);





Route::get('cards', [ApiCardController::class, 'index']);
Route::get('card/{id}', [ApiCardController::class, 'show']);

Route::get('data-communication-sections', [ApiDataCommunicationSectionController::class, 'index']);

Route::get('data-communication-sections/{id}', [ApiDataCommunicationSectionController::class, 'getData']);
//Route::get('data-communications', [ApiDataCommunicationController::class, 'index']);
Route::get('data-communication/{id}', [ApiDataCommunicationController::class, 'show']);


Route::get('app-sections',[ApiAppSectionController::class, 'index']);
Route::get('app-sections/{id}',[ApiAppSectionController::class, 'getApps']);
Route::get('app/{id}',[ApiAppController::class, 'show']);

Route::get('ebank-sections',[ApiEbankSectionController::class, 'index']);
Route::get('ebank-sections/{id}',[ApiEbankSectionController::class, 'getEbanks']);
Route::get('ebank/{id}',[ApiEbankController::class, 'show']);

Route::get('ecard-sections',[ApiEcardSectionController::class, 'index']);

Route::get('ecard-sections/{id}',[ApiEcardSectionController::class, 'getEcards']);
Route::get('ecard/{id}',[ApiEcardController::class, 'show']);

Route::get('game-sections',[ApiGameSectionController::class, 'index']);
Route::get('game-sections/{id}',[ApiGameSectionController::class, 'getGames']);
Route::get('game/{id}',[ApiGameController::class, 'show']);
