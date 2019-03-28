<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use \Response;

class ConfigController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(){
        $userCount = \App\User::where('active','=','1')->count();
        $meetingCount = \App\Meeting::where('active','=','1')->count();
        $meetingTWCount = \App\MeetingTW::where('active','=','1')->count();
        $companyLocationCount = \App\CompanyLocation::where('active','=','1')->count();
        $departmentCount = \App\Department::where('active','=','1')->count();
        $meetingTypeCount = \App\MeetingType::where('active','=','1')->count();
        $meetingGroupCount = \App\MeetingGroup::where('active','=','1')->count();
        
        if(view()->exists('config')){
            return View::make('config', array(
                'userCount' => $userCount,
                'meetingCount' => $meetingCount,
                'meetingTWCount' => $meetingTWCount,
                'companyLocationCount' => $companyLocationCount,
                'departmentCount' => $departmentCount,
                'meetingTypeCount' => $meetingTypeCount,
                'meetingGroupCount' => $meetingGroupCount,
            ));
        }
    }
}
