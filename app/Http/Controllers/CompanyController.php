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
        $due_date_from = Carbon::now()->subMonths(5)->format('Y-m-d');
        $due_date_to = Carbon::now()->format('Y-m-d');
        
        $companyObj = new StdClass();
        $companyObj->company_name = $loginUser->company;
        $departmentsArray = array();
        
        $departmentsArray = DB::table('t_w_s')
            ->select('company_name')
            ->addSelect('department_name')
            ->where('is_visible', true)
            ->where('company_name','=',$companyObj->company_name)
            ->distinct('department_name')
            ->get();
        
        foreach($departmentsArray as $key=>&$value){
            
            $twPassCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where('is_done','=',true);
                $query->whereNotNull('done_date');
                $query->where(DB::raw('DATE(due_date)'),'>=',DB::raw('DATE(done_date)'));
            })
            ->whereDate('due_date','>=',$due_date_from)
            ->whereDate('due_date','<=',$due_date_to)
            ->where(function($query) use ($value){
                $query->where('company_name','=',$value->company_name);
                $query->where('department_name','=',$value->department_name);
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
                ->whereDate('due_date', '>=', $due_date_from)
                //->whereDate('due_date', '<=', $due_date_to)
                ->where(function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
                })
                ->count();
            
            $twFailWithUncompletedCount = TW::where('is_visible','=',true)
                ->where(function($query){
                    $query->whereDate('due_date','<',Carbon::now()->format('Y-m-d'));
                    $query->where(function($query){
                        $query->where('is_done','=',false);
                        $query->orWhereNull('is_done');
                    });
                })
                ->whereDate('due_date', '>=', $due_date_from)
                //->whereDate('due_date', '<=', $due_date_to)
                ->where(function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
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
                ->where(function($query) use ($value){
                    $query->where('company_name','=',$value->company_name);
                    $query->where('department_name','=',$value->department_name);
                })
                ->count();

            $value->twPassCount = $twPassCount;
            $value->twFailWithCompletedCount = $twFailWithCompletedCount;
            $value->twFailWithUncompletedCount = $twFailWithUncompletedCount;
            $value->twInprogressCount = $twInprogressCount;

        }
        
        // get data
        $companyObj->departments = $departmentsArray;
        
        if(view()->exists('company_department_show')){
            return View::make('company_department_show', ['companyObj' => $companyObj]);
        }
    }
}
