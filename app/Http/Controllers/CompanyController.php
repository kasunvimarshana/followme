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

class CompanyController extends Controller
{
    //
    public function showDepartments(Request $request){
        $loginUser = Login::getUserData();
        $date_today = Carbon::now()->format('Y-m-d');
        $date_from = Carbon::now()->subMonths(5)->format('Y-m-d');
        $date_to = Carbon::now()->format('Y-m-d');
        $start_date_from = $date_from;
        $start_date_to = $date_to;
        
        $companyObj = new StdClass();
        $companyObj->company_name = $loginUser->company;
        $departmentsArray = array();
        
        $departmentsArray = DB::table('t_w_users')
            ->select('company_name')
            ->addSelect('department_name')
            ->where('is_visible', true)
            ->where('company_name','=',$companyObj->company_name)
            ->distinct('department_name')
            ->get();
        
        foreach($departmentsArray as $key=>&$value){
            
            $twAllCount = TW::where('is_visible','=',true)
            ->whereDate('start_date','>=',$start_date_from)
            ->whereDate('start_date','<=',$start_date_to)
            ->whereHas('twUsers', function($query) use ($value){
                $query->where('company_name','=',$value->company_name);
                $query->where('department_name','=',$value->department_name);
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
            /*->where(function($query) use ($value){
                $query->where('company_name','=',$value->company_name);
                $query->where('department_name','=',$value->department_name);
            })*/
            ->whereHas('twUsers', function($query) use ($value){
                $query->where('company_name','=',$value->company_name);
                $query->where('department_name','=',$value->department_name);
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
                /*->where(function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
                })*/
                ->whereHas('twUsers', function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
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
                /*->where(function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
                })*/
                ->whereHas('twUsers', function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
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
                /*->where(function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
                })*/
                ->whereHas('twUsers', function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
                    $query->distinct('t_w_id');
                })
                ->count();

            if( $twAllCount == 0 ){
                $twAllCount = 1;
            }
            
            $value->twAllCount = $twAllCount;
            $value->twPassCount = $twPassCount;
            $value->twFailWithCompletedCount = $twFailWithCompletedCount;
            $value->twFailWithUncompletedCount = $twFailWithUncompletedCount;
            $value->twInprogressCount = $twInprogressCount;
            $value->twPassCountPercentage = (($twPassCount / $twAllCount) * 100);
            $value->twFailWithCompletedCountPercentage = (($twFailWithCompletedCount / $twAllCount) * 100);
            $value->twFailWithUncompletedCountPercentage = (($twFailWithUncompletedCount / $twAllCount) * 100);
            $value->twInprogressCountPercentage = (($twInprogressCount / $twAllCount) * 100);

        }
        
        // get data
        $companyObj->departments = $departmentsArray;
        
        if(view()->exists('company_department_show')){
            return View::make('company_department_show', ['companyObj' => $companyObj]);
        }
    }
}