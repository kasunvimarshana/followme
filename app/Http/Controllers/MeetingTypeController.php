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
use \Response;

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
        if(view()->exists('meeting_type_create')){
            return View::make('meeting_type_create');
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
        $meetingTypeData = array(	
            'name'     => Input::get('name'),
            'active'  => '1'
        );
        // Start transaction!
        DB::beginTransaction();

        try {
            // Validate, then create if valid
            $newMeetingType = MeetingType::create( $meetingTypeData );
        }catch(ValidationException $e){
            // Rollback and then redirect
            // back to form with errors
            DB::rollback();
            return redirect()->route('meetingType.create')
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('meetingType.create')
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('Meeting Type Created', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('meetingType.create');
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
        if(view()->exists('meeting_type_edit')){
            return View::make('meeting_type_edit', ['meetingType' => $meetingType]);
        }
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
        $meetingTypeClone = clone $meetingType;
        // validate the info, create rules for the inputs
        $rules = array(
            'name'    => 'required'
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return redirect()->route('meetingType.edit', [$meetingType->id])
            ->withErrors($validator) // send back all errors to the form
            ->withInput(); // send back the input so that we can repopulate the form
        } else {
            // do process
            $meetingTypeData = array(	
                'name'     => Input::get('name'),
                'active'  => '1'
            );
            // Start transaction!
            DB::beginTransaction();

            try {
                // Validate, then update if valid
                $updatedMeetingType = $meetingTypeClone->update( $meetingTypeData );
            }catch(ValidationException $e){
                // Rollback and then redirect
                // back to form with errors
                DB::rollback();
                //throw $e;
                return redirect()-route('meetingType.edit', [$meetingType->id])
                //->withErrors( $e->getErrors() )
                ->withErrors( $e->getMessage() )
                ->withInput();
            }catch(\Exception $e){
                DB::rollback();
                //throw $e;
                return redirect()->route('meetingType.edit', [$meetingType->id])
                //->withErrors( $e->getErrors() )
                ->withErrors( $e->getMessage() )
                ->withInput();
            }

            // If we reach here, then
            // data is valid and working.
            // Commit the queries!
            DB::commit();
            
            notify()->flash('Meeting Type Updated', 'success', [
                'timer' => 3000,
                'text' => 'success'
            ]);
            
            return redirect()->route('meetingType.index');
        }
        
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
        //Model::find(explode(',', $id))->delete();
        // do process
        // Start transaction!
        DB::beginTransaction();

        try {
            // Validate, then delete if valid
            $meetingType->delete();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('meetingType.showAllMeetingTypes');
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('Meeting Type Deleted', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('meetingType.showAllMeetingTypes');
        
    }
    
    //other
    public function listMeetingTypes(Request $request){
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
        
        $metingType = new MeetingType();
        
        $query = $metingType->where('active', '=', '1');
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
    
    public function showAllMeetingTypes(Request $request){
        if(view()->exists('meeting_type_list_all')){
            return View::make('meeting_type_list_all');
        }
    }
    
}
