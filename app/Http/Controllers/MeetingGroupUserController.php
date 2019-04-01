<?php

namespace App\Http\Controllers;

use App\MeetingGroupUser;
use Illuminate\Http\Request;

use \Response;
use App\MeetingGroup;

class MeetingGroupUserController extends Controller
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
     * @param  \App\MeetingGroupUser  $meetingGroupUser
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingGroupUser $meetingGroupUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeetingGroupUser  $meetingGroupUser
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingGroupUser $meetingGroupUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeetingGroupUser  $meetingGroupUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingGroupUser $meetingGroupUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeetingGroupUser  $meetingGroupUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingGroupUser $meetingGroupUser)
    {
        //
        //Model::find(explode(',', $id))->delete();
        // do process
        // Start transaction!
        DB::beginTransaction();
        $meetingGroupId = $meetingGroupUser->meeting_group_id;

        try {
            // Validate, then delete if valid
            $meetingGroupUser->delete();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('meetingGroupUser.showAllMeetingGroupUsers', [$meetingGroupId]);
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('Group User Deleted', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('meetingGroupUser.showAllMeetingGroupUsers', [$meetingGroupId]);
    }
    
    //other
    public function listMeetingGroupUsers(Request $request){
        // Solution to get around integer overflow errors
        // $model->latest()->limit(PHP_INT_MAX)->offset(1)->get();
        // function will process the ajax request
        $draw = null;
        $start = 0;
        $length = 0;
        $search = null;
        
        $recordsTotal = 0;
        $recordsFiltered = 0;
        $query = null;
        $queryResult = null;
        //$recordsTotal = Model::where('active','=','1')->count();
        
        $draw = $request->get('draw');
        
        $meetingGroupUser = new MeetingGroupUser();
        
        $query = $meetingGroupUser->with(['meetingGroup', 'user'])->where('active', '=', '1');
        $recordsTotal = $query->count();
        $recordsFiltered = $recordsTotal;
            
        // get search query value
        if( ($request->get('search')) && (!empty($request->get('search'))) ){
            $search = $request->get('search');
            if( $search && (@key_exists('value', $search)) ){
                $search = $search['value'];
            }
            if($search && (!empty($search))){
                //$search = (string) $search;
                $query = $query->where('name', 'like', '%' . $search . '%');
            }
        }
        
        // meeting type
        if( $request->get('meeting_group_id') ){
            $meetingGroupId = intval( $request->get('meeting_group_id') );
            $query = $query->where('meeting_group_id', '=', $meetingGroupId);
        }
        // company
        if( $request->get('user_id') ){
            $userId = intval( $request->get('user_id') );
            $query = $query->where('user_id', '=', $userId);
        }
        
        // get filtered record count
        $recordsFiltered = $query->count();
        
        // get limit value
        if( $request->get('length') ){
            $length = intval( $request->get('length') );
            $query = $query->limit($length);
        }
        // set default value for length (PHP_INT_MAX)
        if( $length <= 0 ){
            $length = PHP_INT_MAX;
            //$length = 0;
        }
        
        // get offset value
        if( $request->get('start') ){
            $start = intval( $request->get('start') );
        }else if( $request->get('page') ){
            $start = intval( $request->get('page') );
            //$start = abs( ( ( $start - 1 ) * $length ) );
            $start = ( ( $start - 1 ) * $length );
        }
        
        // filter with offset value
        if( $start > 0 ){
            //$query = $query->limit($length)->skip($start);
            $query = $query->limit($length)->offset($start);
        }
        
        // get data
        $queryResult = $query->get();
        
        $recordsTotal = $recordsFiltered;
        $data = array(
            'draw' => $draw,
            'start' => $start,
            'length' => $length,
            'search' => $search,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $queryResult,
        );
        
        return Response::json( $data );
    }
    
    public function createMeetingGroupUser(Request $request, MeetingGroup $meetingGroup){
        if(view()->exists('meeting_group_user_create')){
            return View::make('meeting_group_user_create', ['meetingGroup' => $meetingGroup]);
        }
    }
    
    public function storeMeetingGroupUser(Request $request, MeetingGroup $meetingGroup){
        // do process
        $meetingGroupUserData = array(	
            'meeting_group_id'     => $meetingGroup->id,
            'user_id'     => Input::get('user_id'),
            'active'     => '1'
        );
        // Start transaction!
        DB::beginTransaction();

        try {
            // Validate, then create if valid
            $newMeetingGroupUser = MeetingGroupUser::create( $meetingGroupUserData );
        }catch(ValidationException $e){
            // Rollback and then redirect
            // back to form with errors
            DB::rollback();
            return redirect()-route('meetingGroupUser.createMeetingGroupUser', [$meetingGroup->id])
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('meetingGroupUser.createMeetingGroupUser', [$meetingGroup->id])
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('User Added To Group', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('meetingGroupUser.createMeetingGroupUser', [$meetingGroup->id]);
    }
    
    public void showAllMeetingGroupUsers(Request $request, MeetingGroup $meetingGroup){
        if(view()->exists('meeting_group_user_list_all')){
            return View::make('meeting_group_user_list_all', [$meetingGroup->id]);
        }
    }
}
