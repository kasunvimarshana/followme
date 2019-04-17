<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use \Response;

use App\TW;
use App\Login;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    public function __construct(){
        
    }
    
    public function index(){
        $loginUser = Login::getUserData();
        
        $twTodayCount = TW::where('is_visible','=',true)->where('is_done','=',false)->whereDate('due_date','=',Carbon::now()->format('Y-m-d'))->whereHas('twUsers', function($query) use ($loginUser){
            $query->where('own_user','=',$loginUser->mail);
        })->count();
        
        $twTodayCreatedCount = TW::where('is_visible','=',true)->where('created_user','=',$loginUser->mail)->whereDate('created_at','=',Carbon::now()->format('Y-m-d'))->count();
        
        $twCompletedCount = TW::where('is_visible','=',true)->where('is_done','=',true)->whereDate('due_date','>=',Carbon::now()->subMonths(5)->format('Y-m-d'))->whereHas('twUsers', function($query) use ($loginUser){
            $query->where('own_user','=',$loginUser->mail);
        })->count();
        
        $twFailCount = TW::where('is_visible','=',true)->where('is_done','=',false)->whereDate('due_date','>=',Carbon::now()->subMonths(5)->format('Y-m-d'))->whereDate('due_date','<',Carbon::now()->format('Y-m-d'))->whereHas('twUsers', function($query) use ($loginUser){
            $query->where('own_user','=',$loginUser->mail);
        })->count();
        
        $twInprogressCount = TW::where('is_visible','=',true)->where('is_done','=',false)->whereDate('due_date','=',Carbon::now()->format('Y-m-d'))->whereHas('twUsers', function($query) use ($loginUser){
            $query->where('own_user','=',$loginUser->mail);
        })->count();
        
        if(view()->exists('home')){
            return View::make('home', array(
                'twTodayCount' => $twTodayCount,
                'twTodayCreatedCount' => $twTodayCreatedCount,
                'twCompletedCount' => $twCompletedCount,
                'twFailCount' => $twFailCount,
                'twInprogressCount' => $twInprogressCount
            ));
        }
    }
}
