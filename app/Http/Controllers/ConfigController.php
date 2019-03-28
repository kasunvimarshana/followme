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
        return View::make('config');
    }
}
