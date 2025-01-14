<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use App\Models\App;
use App\Models\DataCommunicationOrder;
use App\Models\GameOrder;
use App\Models\EcardOrder;
use App\Models\CardOrder;
use App\Models\ProgramOrder;
use App\Models\ServiceOrder;
use App\Models\EbankeOrder;
use App\Observers\GeneralObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
       
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        App::observe(GeneralObserver::class);
        DataCommunicationOrder::observe(GeneralObserver::class);
        GameOrder::observe(GeneralObserver::class);
        EcardOrder::observe(GeneralObserver::class);
        ProgramOrder::observe(GeneralObserver::class);
        ServiceOrder::observe(GeneralObserver::class);
        CardOrder::observe(GeneralObserver::class);
    }
}

