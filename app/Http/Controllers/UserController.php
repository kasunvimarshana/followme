<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Auth;

class UserController extends Controller
{
    //
    public function index(){
        if(view()->exists('user')){
            $count = \App\User::where('status','=','1')->count();
            return View::make('user', array('count' => $count));
        }
    }
    
    public function showCreate(){
        if(view()->exists('user_create')){
            return View::make('user_create');
        }
    }
}
