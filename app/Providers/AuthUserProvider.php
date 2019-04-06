<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use App\Login;

class AuthUserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    /*public function boot(Request $request)
    {
        view()->share('user', $request->user());
    }*/
    /*public function boot()
    {
        if(Auth::check()){
            view()->composer('*', function($view){
                $view->with('user', auth()->user());
            });
        }
    }*/
    
    public function boot()
    {
        //
        view()->composer('*', function($view){
            $user = Login::getUserData();
            $view->with('auth_user', $user);
        });
    }
}
