<?php

namespace App\Http\Controllers;

use App\MeetingType;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use DB;

class MeetingTypeController extends Controller
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
        if(view()->exists('meeting_type')){
            $count = MeetingType::where('active','=','1')->count();
            return View::make('meeting_type', array('count' => $count));
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
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingType $meetingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingType $meetingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingType $meetingType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingType $meetingType)
    {
        //
    }
}
