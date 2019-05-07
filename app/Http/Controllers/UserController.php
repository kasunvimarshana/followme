<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
//use Auth;
//use DB;
use App\User;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Response;

use App\LDAPModel;
use LdapQuery\Builder; 
use Illuminate\Http\JsonResponse;
use App\TW;
use App\Login;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    
    //other
    public function listUsers(Request $request){
        // Solution to get around integer overflow errors
        // $model->latest()->limit(PHP_INT_MAX)->offset(1)->get();
        // function will process the ajax request
        $draw = null;
        $start = 0;
        $length = 0;
        $search = null;
        
        $recordsTotal = 0;
        $recordsFiltered = 0;
        $query = null;
        $queryResult = null;
        //$recordsTotal = Model::where('active','=','1')->count();
        
        $draw = $request->get('draw');
        
        $user = new User();
        $ldapModel = new LDAPModel();
        $query = new Builder();
        //$ldapModel->setOption(LDAP_OPT_SIZELIMIT, 1000);
            
        // get search query value
        if( ($request->get('search')) && (!empty($request->get('search'))) ){
            $search = $request->get('search');
            if( $search && (@key_exists('value', $search)) ){
                $search = $search['value'];
            }
            if($search && (!empty($search))){
                //$search = (string) $search;
                $query = $query->whereRaw('mail', '=', $search . '*');
            }
        }
        
        // employeenumber
        if( ($request->get('employeenumber')) && (!empty($request->get('employeenumber'))) ){
            $employeenumber = $request->get('employeenumber');
            $query = $query->whereRaw('employeenumber', '=', $employeenumber);
        }
        
        // cn
        if( ($request->get('cn')) && (!empty($request->get('cn'))) ){
            $cn =  $request->get('cn');
            $query = $query->whereRaw('cn', '=', '*' . $cn . '*');
        }
        
        // department
        if( ($request->get('department')) && (!empty($request->get('department'))) ){
            $department = $request->get('department');
            $query = $query->whereRaw('department', '=', $department);
        }
        
        // mobile
        if( ($request->get('mobile')) && (!empty($request->get('mobile'))) ){
            $mobile = $request->get('mobile');
            $query = $query->whereRaw('mobile', '=', $mobile);
        }
        
        // get data
        $queryResult = (array) $user->findUsers( $query->stringify() );
        $recordsFiltered = count($queryResult, 0);
        
        $recordsTotal = $recordsFiltered;
        $data = array(
            'draw' => $draw,
            'start' => $start,
            'length' => $length,
            'search' => $search,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $queryResult
        );
        
        return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        //return Response::json( $data );
    }
    
    public function listDirectReports(Request $request, $user){
        $draw = null;
        $start = 0;
        $length = 0;
        $search = null;
        
        $recordsTotal = 0;
        $recordsFiltered = 0;
        $query = null;
        $queryResult = null;
        //$recordsTotal = Model::where('active','=','1')->count();
        
        $draw = $request->get('draw');
        
        $requestUser = new User();
        $requestUser->mail = urldecode($user);
        $requestUser->getUser();
        //$requestUser = Login::getUserData();
        $directReportsArray = $requestUser->getDirectReports();
        
        $due_date_from = Carbon::now()->subMonths(5)->format('Y-m-d');
        $due_date_to = Carbon::now()->format('Y-m-d');
        foreach($directReportsArray as $key=>&$value){

            $twCompletedCount = TW::where('is_visible','=',true)
                ->where('is_done','=',true)
                ->whereDate('due_date','>=',$due_date_from)
                ->whereDate('due_date','<=',$due_date_to)
                ->whereHas('twUsers', function($query) use ($value){
                    $query->where('own_user','=',$value->mail);
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
                ->whereHas('twUsers', function($query) use ($value){
                    $query->where('own_user','=',$value->mail);
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
                ->whereHas('twUsers', function($query) use ($value){
                    $query->where('own_user','=',$value->mail);
                })
                ->count();

            $value->twCompletedCount = $twCompletedCount;
            $value->twFailCount = $twFailCount;
            $value->twInprogressCount = $twInprogressCount;

        }
        
        // get data
        $queryResult = (array) $directReportsArray;
        $recordsFiltered = count($queryResult, 0);
        
        $recordsTotal = $recordsFiltered;
        $data = array(
            'draw' => $draw,
            'start' => $start,
            'length' => $length,
            'search' => $search,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $queryResult
        );
        
        return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    
    public function showDirectReports(Request $request){
        if(view()->exists('subordinate_show')){
            return View::make('subordinate_show');
        }
    }
    
    public function showDirectReportTW(Request $request, $user){
        $directReportUser = new User();
        $directReportUser->mail = urldecode($user);
        $directReportUser->getUser();
        if(view()->exists('subordinate_tw_show')){
            return View::make('subordinate_tw_show', ['directReportUser' => $directReportUser]);
        }
    }
    
}
