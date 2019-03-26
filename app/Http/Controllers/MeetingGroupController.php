<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Auth;

class MeetingGroupController extends Controller
{
    //
    public function index(){
        if(view()->exists('meeting_group')){
            return View::make('meeting_group');
        }
    }
}
