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
use \Response;

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
        if(view()->exists('meeting_group_create')){
            return View::make('meeting_group_create');
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
        // do process
        $meetingGroupData = array(	
            'meeting_type_id'     => Input::get('meeting_type_id'),
            'company_id'     => Input::get('company_id'),
            'department_id'     => Input::get('department_id'),
            'name'     => Input::get('name'),
            'description'     => Input::get('description'),
            'active'     => '1'
        );
        // Start transaction!
        DB::beginTransaction();

        try {
            // Validate, then create if valid
            $newMeetingGroup = MeetingGroup::create( $meetingGroupData );
        }catch(ValidationException $e){
            // Rollback and then redirect
            // back to form with errors
            DB::rollback();
            return redirect()-route('meetingGroup.create')
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('meetingGroup.create')
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('Group Created', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('meetingGroup.create');
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
        if(view()->exists('meeting_group_edit')){
            return View::make('meeting_group_edit', ['meetingGroup' => $meetingGroup]);
        }
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
        $meetingGroupClone = clone $meetingGroup;
        // validate the info, create rules for the inputs
        $rules = array(
            'name'    => 'required'
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return redirect()->route('meetingGroup.edit', [$meetingGroup->id])
            ->withErrors($validator) // send back all errors to the form
            ->withInput(); // send back the input so that we can repopulate the form
        } else {
            // do process
            $meetingGroupData = array(	
                'meeting_type_id'     => Input::get('meeting_type_id'),
                'company_id'     => Input::get('company_id'),
                'department_id'     => Input::get('department_id'),
                'name'     => Input::get('name'),
                'description'     => Input::get('description'),
                'active'     => '1'
            );
            // Start transaction!
            DB::beginTransaction();

            try {
                // Validate, then update if valid
                $updatedMeetingGroup = $meetingGroupClone->update( $meetingGroupData );
            }catch(ValidationException $e){
                // Rollback and then redirect
                // back to form with errors
                DB::rollback();
                //throw $e;
                return redirect()-route('meetingGroup.edit', [$meetingGroup->id])
                //->withErrors( $e->getErrors() )
                ->withErrors( $e->getMessage() )
                ->withInput();
            }catch(\Exception $e){
                DB::rollback();
                //throw $e;
                return redirect()->route('meetingGroup.edit', [$meetingGroup->id])
                //->withErrors( $e->getErrors() )
                ->withErrors( $e->getMessage() )
                ->withInput();
            }

            // If we reach here, then
            // data is valid and working.
            // Commit the queries!
            DB::commit();
            
            notify()->flash('Group Updated', 'success', [
                'timer' => 3000,
                'text' => 'success'
            ]);
            
            return redirect()->route('meetingGroup.index');
        }
        
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
        //Model::find(explode(',', $id))->delete();
        // do process
        // Start transaction!
        DB::beginTransaction();

        try {
            // Validate, then delete if valid
            $meetingGroup->delete();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('meetingGroup.showAllMeetingGroups');
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('Group Deleted', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('meetingGroup.showAllMeetingGroups');
        
    }
    
    //other
    public function listMeetingGroups(Request $request){
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
        
        $meetingGroup = new MeetingGroup();
        
        $query = $meetingGroup->with(['meetingType', 'company', 'department'])->where('active', '=', '1');
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
        if( $request->get('meeting_type_id') ){
            $meetingTypeId = intval( $request->get('meeting_type_id') );
            $query = $query->where('meeting_type_id', '=', $meetingTypeId);
        }
        // company
        if( $request->get('company_id') ){
            $companyId = intval( $request->get('company_id') );
            $query = $query->where('company_id', '=', $companyId);
        }
        // department
        if( $request->get('department_id') ){
            $departmentId = intval( $request->get('department_id') );
            $query = $query->where('department_id', '=', $departmentId);
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
    
    public function showAllMeetingGroups(Request $request){
        if(view()->exists('meeting_group_list_all')){
            return View::make('meeting_group_list_all');
        }
    }
    
}
