<?php

namespace App\Http\Controllers;

use App\TWInfo;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use \Response; 

use DB;
use App\Login;
use App\Enums\Status;
use App\Enums\TWMeta;
use App\TWUser;
use App\User;
use App\TW;
use App\UserAttachment;
use Storage;

class TWInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, TW $tW)
    {
        //
        if(view()->exists('tw_info_create')){
            return View::make('tw_info_create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function show(TWInfo $tWInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(TWInfo $tWInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TWInfo $tWInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TWInfo $tWInfo)
    {
        //
    }
}
