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
use DB;

class HomeController extends Controller
{
    //
    public function __construct(){
        
    }
    
    public function index(){
        $loginUser = Login::getUserData();
        $due_date_from = Carbon::now()->subMonths(5)->format('Y-m-d');
        $due_date_to = Carbon::now()->format('Y-m-d');
        
        $twTodayCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where('is_done','=',false);
                $query->orWhereNull('is_done');
            })
            ->whereDate('due_date','=',$due_date_to)
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('own_user','=',$loginUser->mail);
            })
            ->count();
        
        $twTodayCreatedCount = TW::where('is_visible','=',true)
            ->where('created_user','=',$loginUser->mail)
            ->whereDate('created_at','=',$due_date_to)
            ->count();
        
        $twCompletedCount = TW::where('is_visible','=',true)
            ->where('is_done','=',true)
            ->whereDate('due_date','>=',$due_date_from)
            ->whereDate('due_date','<=',$due_date_to)
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('own_user','=',$loginUser->mail);
            })
            ->count();
        
        $twFailCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where(function($query){
                    $query->whereNotNull('done_date');
                    $query->where(DB::raw('DATE(due_date)'),'<',DB::raw('DATE(done_date)'));
                });
                $query->orWhere(function($query){
                    $query->whereDate('due_date','<',Carbon::now()->format('Y-m-d'));
                    $query->where(function($query){
                        $query->where('is_done','=',false);
                        $query->orWhereNull('is_done');
                    });
                });
            })
            ->whereDate('due_date', '>=', $due_date_from)
            //->whereDate('due_date', '<=', $due_date_to)
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('own_user','=',$loginUser->mail);
            })
            ->count();
        
        $twInprogressCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where('is_done','=',false);
                $query->orWhereNull('is_done');
            })
            ->where(function($query){
                //$query->whereRaw('due_date >= done_date');
                $query->orWhereDate('due_date','>=',Carbon::now()->format('Y-m-d'));
            })
            ->whereDate('due_date','>=', $due_date_from)
            //->whereDate('due_date','<=', $due_date_to)
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('own_user','=',$loginUser->mail);
            })
            ->count();
        
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
