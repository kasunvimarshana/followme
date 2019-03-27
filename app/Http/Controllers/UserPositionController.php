<?php

namespace App\Http\Controllers;

use App\UserPosition;
use Illuminate\Http\Request;

class UserPositionController extends Controller
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
     * @param  \App\UserPosition  $userPosition
     * @return \Illuminate\Http\Response
     */
    public function show(UserPosition $userPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPosition  $userPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPosition $userPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPosition  $userPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPosition $userPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPosition  $userPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPosition $userPosition)
    {
        //
    }
    
    //other
    public function listUserPosition(Request $request){
        // Solution to get around integer overflow errors
        // $model->latest()->limit(PHP_INT_MAX)->offset(1)->get();
    }
    
}
