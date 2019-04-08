<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use \Response;

class HomeController extends Controller
{
    //
    public function __construct(){
        
    }
    
    public function index(){
        $data = array();
        
        if(view()->exists('home')){
            return View::make('home', array(
                'data' => $data,
                'data1' => $data
            ));
        }
    }
}
