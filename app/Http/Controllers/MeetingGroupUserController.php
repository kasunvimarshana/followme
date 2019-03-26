<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Auth;

class MeetingGroupUserController extends Controller
{
    //
    public function index(){
        if(view()->exists('meeting_group_user')){
            return View::make('meeting_group_user');
        }
    }
}
