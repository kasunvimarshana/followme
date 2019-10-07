<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Queue;

use App\TW;
use App\App\Observers\TWObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        /*
        Solve
        Illuminate\Database\QueryException  : SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long;
        */
        Schema::defaultStringLength(191);
        
        /*Queue::failing(function ($connection, $job, $data) {
            Log::error('Job failed!');
        });*/
        TW::observe(TWObserver::class);
    }
}
