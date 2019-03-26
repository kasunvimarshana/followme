<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Auth;

class CompanyLocationController extends Controller
{
    //
    public function index(){
        if(view()->exists('company_location')){
            return View::make('company_location');
        }
    }
}
