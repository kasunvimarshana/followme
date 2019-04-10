<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use \Response;

use App\TW;
use App\Login;

class HomeController extends Controller
{
    //
    public function __construct(){
        
    }
    
    public function index(){
        $loginUser = Login::getUserData();
        
        $twTodayCount = TW::where('is_visible','=','1')->where('is_done', 0)->where('due_date', date('Y-m-d'))->whereHas('twUsers', function($query) use ($loginUser){
            $query->where('own_user', '=', $loginUser->mail);
        })->count();
        
        $twTodayCreatedCount = TW::where('is_visible','=','1')->where('created_user', $loginUser->mail)->count();
        
        $twPassCount = 10;
        $twFailCount = 20;
        
        if(view()->exists('home')){
            return View::make('home', array(
                'twTodayCount' => $twTodayCount,
                'twTodayCreatedCount' => $twTodayCreatedCount,
                'twPassCount' => $twPassCount,
                'twFailCount' => $twFailCount,
            ));
        }
    }
}
