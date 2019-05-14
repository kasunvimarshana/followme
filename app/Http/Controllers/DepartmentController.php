<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use App\User;
use Illuminate\Support\Str;
use \Response;

use App\LDAPModel;
use LdapQuery\Builder; 
use Illuminate\Http\JsonResponse;
use App\TW;
use App\Login;
use Carbon\Carbon;
use DB;
use \StdClass;

class DepartmentController extends Controller
{
    //
    public function showDepartments(Request $request){
        $loginUser = Login::getUserData();
        $date_today = Carbon::now()->format('Y-m-d');
        $date_from = Carbon::now()->subMonths(5)->format('Y-m-d');
        $date_to = Carbon::now()->format('Y-m-d');
        $start_date_from = $date_from;
        $start_date_to = $date_to;
        
        $departmentObj = new StdClass();
        $departmentObj->company_name = $loginUser->company;
        $departmentObj->department_name = $loginUser->department;
        
        $twAllCount = TW::where('is_visible','=',true)
            ->whereDate('start_date','>=',$start_date_from)
            ->whereDate('start_date','<=',$start_date_to)
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
                $query->distinct('t_w_id');
            })
            ->count();
        
        $twPassCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where('is_done','=',true);
                $query->whereNotNull('done_date');
                $query->where(DB::raw('DATE(due_date)'),'>=',DB::raw('DATE(done_date)'));
            })
            ->whereDate('start_date','>=',$start_date_from)
            ->whereDate('start_date','<=',$start_date_to)
            /*->where(function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
            })*/
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
                $query->distinct('t_w_id');
            })
            ->count();

        $twFailWithCompletedCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where(function($query){
                    $query->where('is_done','=',true);
                    $query->whereNotNull('done_date');
                    $query->where(DB::raw('DATE(due_date)'),'<',DB::raw('DATE(done_date)'));
                });
            })
            ->whereDate('start_date', '>=', $start_date_from)
            ->whereDate('start_date', '<=', $start_date_to)
            /*->where(function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
            })*/
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
                $query->distinct('t_w_id');
            })
            ->count();

        $twFailWithUncompletedCount = TW::where('is_visible','=',true)
            ->where(function($query) use ($date_today){
                $query->whereDate('due_date','<',$date_today);
                $query->where(function($query){
                    $query->where('is_done','=',false);
                    $query->orWhereNull('is_done');
                });
            })
            ->whereDate('start_date', '>=', $start_date_from)
            ->whereDate('start_date', '<=', $start_date_to)
            /*->where(function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
            })*/
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
                $query->distinct('t_w_id');
            })
            ->count();

        $twInprogressCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where('is_done','=',false);
                $query->orWhereNull('is_done');
            })
            ->where(function($query) use ($date_today){
                //$query->whereRaw('due_date >= done_date');
                $query->orWhereDate('due_date','>=',$date_today);
            })
            ->whereDate('start_date','>=', $start_date_from)
            ->whereDate('start_date','<=', $start_date_to)
            /*->where(function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
            })*/
            ->whereHas('twUsers', function($query) use ($loginUser){
                $query->where('company_name','=',$loginUser->company);
                $query->where('department_name','=',$loginUser->department);
                $query->distinct('t_w_id');
            })
            ->count();
        
        if( $twAllCount == 0 ){
            $twAllCount = 1;
        }
        
        $departmentObj->twAllCount = $twAllCount;
        $departmentObj->twPassCount = $twPassCount;
        $departmentObj->twFailWithCompletedCount = $twFailWithCompletedCount;
        $departmentObj->twFailWithUncompletedCount = $twFailWithUncompletedCount;
        $departmentObj->twInprogressCount = $twInprogressCount;
        $departmentObj->twPassCountPercentage = (($twPassCount / $twAllCount) * 100);
        $departmentObj->twFailWithCompletedCountPercentage = (($twFailWithCompletedCount / $twAllCount) * 100);
        $departmentObj->twFailWithUncompletedCountPercentage = (($twFailWithUncompletedCount / $twAllCount) * 100);
        $departmentObj->twInprogressCountPercentage = (($twInprogressCount / $twAllCount) * 100);
        
        if(view()->exists('department_show')){
            return View::make('department_show', ['departmentObj' => $departmentObj]);
        }
    }
}