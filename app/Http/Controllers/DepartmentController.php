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
        $due_date_from = Carbon::now()->subMonths(5)->format('Y-m-d');
        $due_date_to = Carbon::now()->format('Y-m-d');
        
        $departmentObj = new StdClass();
        $departmentObj->company_name = $loginUser->company;
        $departmentObj->department_name = $loginUser->department;
        
        $twPassCount = TW::where('is_visible','=',true)
            ->where(function($query){
                $query->where('is_done','=',true);
                $query->whereNotNull('done_date');
                $query->where(DB::raw('DATE(due_date)'),'>=',DB::raw('DATE(done_date)'));
            })
            ->whereDate('due_date','>=',$due_date_from)
            ->whereDate('due_date','<=',$due_date_to)
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
            ->whereDate('due_date', '>=', $due_date_from)
            //->whereDate('due_date', '<=', $due_date_to)
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
            ->where(function($query){
                $query->whereDate('due_date','<',Carbon::now()->format('Y-m-d'));
                $query->where(function($query){
                    $query->where('is_done','=',false);
                    $query->orWhereNull('is_done');
                });
            })
            ->whereDate('due_date', '>=', $due_date_from)
            //->whereDate('due_date', '<=', $due_date_to)
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
            ->where(function($query){
                //$query->whereRaw('due_date >= done_date');
                $query->orWhereDate('due_date','>=',Carbon::now()->format('Y-m-d'));
            })
            ->whereDate('due_date','>=', $due_date_from)
            //->whereDate('due_date','<=', $due_date_to)
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
        
        $departmentObj->twPassCount = $twPassCount;
        $departmentObj->twFailWithCompletedCount = $twFailWithCompletedCount;
        $departmentObj->twFailWithUncompletedCount = $twFailWithUncompletedCount;
        $departmentObj->twInprogressCount = $twInprogressCount;
        
        if(view()->exists('department_show')){
            return View::make('department_show', ['departmentObj' => $departmentObj]);
        }
    }
}
