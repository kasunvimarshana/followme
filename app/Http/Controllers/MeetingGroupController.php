<?php

namespace App\Http\Controllers;

use App\MeetingGroup;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use DB;

class MeetingGroupController extends Controller
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
        if(view()->exists('meeting_group')){
            $count = MeetingGroup::where('active','=','1')->count();
            return View::make('meeting_group', array('count' => $count));
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
     * @param  \App\MeetingGroup  $meetingGroup
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingGroup $meetingGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeetingGroup  $meetingGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingGroup $meetingGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeetingGroup  $meetingGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingGroup $meetingGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeetingGroup  $meetingGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingGroup $meetingGroup)
    {
        //
    }
}
