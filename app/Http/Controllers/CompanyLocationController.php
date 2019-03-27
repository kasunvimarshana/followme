<?php

namespace App\Http\Controllers;

use App\CompanyLocation;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use DB;

class CompanyLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd( Model::find(1) );
        if(view()->exists('company_location')){
            $count = CompanyLocation::where('active','=','1')->count();
            return View::make('company_location', array('count' => $count));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyLocation $companyLocation)
    {
        //
    }
}
