<?php

namespace App\Http\Controllers;

use App\TW;
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
use App\Enums\TWStatusEnum;
use App\Enums\TWMetaEnum;
use App\TWUser;
use App\User;
use App\TWInfo;
use App\UserAttachment;
use Storage;

class TWController extends Controller
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
        if(view()->exists('tw_create')){
            return View::make('tw_create');
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
        $data = array('title' => '', 'text' => '', 'type' => '', 'timer' => 3000);
        /*DB::transaction(function () {
            DB::table('table_1')->update(['column' => 1]);
            DB::table('table_2')->delete();
        });*/
        // validate the info, create rules for the inputs
        $rules = array(
            'title'    => 'required'
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            
            $data = array(
                'title' => 'error',
                'text' => 'error',
                'type' => 'warning',
                'timer' => 3000
            );

            return Response::json( $data ); 
            
        } else {
            // do process
            $current_user = Login::getUserData()->mail;
            $twResourceDir = TWMetaEnum::RESOURCE_DIR .'/'. uniqid( time() ) . '_';
            
            $twData = array(	
                'meeting_category_id'     => Input::get('meeting_category_id'),
                'title'     => Input::get('title'),
                'start_date'     => Input::get('start_date'),
                'due_date'     => Input::get('due_date'),
                'description'     => Input::get('description'),
                'created_user'     => $current_user,
                'is_visible' => true,
                'status_id' => TWStatusEnum::OPEN,
                'resource_dir' => $twResourceDir
            );
            
            $twUserData = (array) Input::get('own_user');
            
            $userAttachmentData = (array) $request->file('var_user_attachment');
            
            // Start transaction!
            DB::beginTransaction();

            try {
                //create directory
                if(!Storage::exists($twResourceDir)) {
                    Storage::makeDirectory($twResourceDir, 0775, true); //creates directory
                }
                // Validate, then create if valid
                $newTW = TW::create( $twData );
                
                $newTWInfo = TWInfo::create(array(
                    'is_visible' => true,
                    't_w_id' => $newTW->id,
                    'description' => $newTW->description,
                    'created_user' => $current_user
                ));
                
                foreach($twUserData as $key => $value){
                    $tempTWUser = new User();
                    $tempTWUser->mail = $value;
                    $tempTWUser = $tempTWUser->getUser();
                    
                    $newTWUser = TWUser::create(array(
                        't_w_id' => $newTW->id,
                        'is_visible' => true,
                        'own_user' => $tempTWUser->mail,
                        'company_name' => $tempTWUser->company,
                        'department_name' => $tempTWUser->department
                    ));
                }
                
                if( $request->hasFile('var_user_attachment') ){
                    foreach($userAttachmentData as $key => $value){
                        $file_original_name = $value->getClientOriginalName();
                        $file_type = $value->getClientOriginalExtension();
                        $filename = $value->store( $twResourceDir );
                        $newUserAttachment = $newTWInfo->userAttachments()->create(array(
                            'is_visible' => true,
                            'attached_by' => $current_user,
                            'file_original_name' => $file_original_name,
                            //'attachable_type' => get_class( $newTWInfo ),
                            //'attachable_id' => $newTWInfo->id,
                            'file_type' => $file_type,
                            'link_url' => $filename
                        ));
                    }
                }
            }catch(\Exception $e){
                
                DB::rollback();
                
                //delete directory
                if(Storage::exists($twResourceDir)) {
                    Storage::deleteDirectory($twResourceDir);
                }
                
                $data = array(
                    'title' => 'error',
                    'text' => 'error',
                    'type' => 'warning',
                    'timer' => 3000
                );

                return Response::json( $data ); 
                
            }

            // If we reach here, then
            // data is valid and working.
            // Commit the queries!
            DB::commit();
        }
        
        $data = array(
            'title' => 'success',
            'text' => 'success',
            'type' => 'success',
            'timer' => 3000
        );
        
        return Response::json( $data ); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TW  $tW
     * @return \Illuminate\Http\Response
     */
    public function show(TW $tW)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TW  $tW
     * @return \Illuminate\Http\Response
     */
    public function edit(TW $tW)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TW  $tW
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TW $tW)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TW  $tW
     * @return \Illuminate\Http\Response
     */
    public function destroy(TW $tW)
    {
        //
        $data = array('title' => '', 'text' => '', 'type' => '', 'timer' => 3000);
        //Model::find(explode(',', $id))->delete();
        // do process
        // Start transaction!
        DB::beginTransaction();

        try {
            
            //delete directory
            if(Storage::exists($tW->resource_dir)) {
                Storage::deleteDirectory($tW->resource_dir);
            }
            
            $tW->twInfos()->delete();
            $tW->twUsers()->delete();
            $tW->delete();
            
        }catch(\Exception $e){
            DB::rollback();
            
            $data = array(
                'title' => 'error',
                'text' => 'error',
                'type' => 'warning',
                'timer' => 3000
            );

            return Response::json( $data );
        }

        DB::commit();

        $data = array(
            'title' => 'success',
            'text' => 'success',
            'type' => 'success',
            'timer' => 3000
        );

        return Response::json( $data );
    }
    
    //other
    public function listTWs(Request $request){
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
        
        $tw = new TW();
        
        $query = $tw->with(['twUsers', 'twInfos', 'status'])->where('is_visible', '=', true);
        
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
                $query = $query->where('title', 'like', '%' . $search . '%');
            }
        }
        
        // created_user
        if( ($request->get('created_user')) && (!empty($request->get('created_user'))) ){
            $created_user = $request->get('created_user');
            $query = $query->where('created_user', '=', $created_user);
        }
        
        // meeting_category_id
        if( ($request->get('meeting_category_id')) && (!empty($request->get('meeting_category_id'))) ){
            $meeting_category_id =  $request->get('meeting_category_id');
            $query = $query->where('meeting_category_id', '=', $meeting_category_id);
        }
        
        // status
        if( ($request->get('status_id')) && (!empty($request->get('status_id'))) ){
            $status_id =  $request->get('status_id');
            $query = $query->where('status_id', '=', $status_id);
        }
        
        // start date
        if( ($request->get('start_date')) && (!empty($request->get('start_date'))) ){
            $start_date =  $request->get('start_date');
            $query = $query->whereDate('start_date', '=', $start_date);
        }
        
        // due date
        if( ($request->get('due_date')) && (!empty($request->get('due_date'))) ){
            $due_date =  $request->get('due_date');
            $query = $query->whereDate('due_date', '=', $due_date);
        }
        
        // created date
        if( ($request->get('created_at')) && (!empty($request->get('created_at'))) ){
            $created_at =  $request->get('created_at');
            $query = $query->whereDate('created_at', '=', $created_at);
        }
        
        // updated date
        if( ($request->get('updated_at')) && (!empty($request->get('updated_at'))) ){
            $updated_at =  $request->get('updated_at');
            $query = $query->whereDate('updated_at', '=', $updated_at);
        }
        
        // own user
        if( ($request->get('own_user')) && (!empty($request->get('own_user'))) ){
            $own_user =  $request->get('own_user');
            $query = $query->whereHas('twUsers', function($query) use ($own_user){
                $query->where('own_user', '=', $own_user);
            });
        }
        
        // is_visible
        if( ($request->get('is_visible') != null) ){
            $is_visible =  $request->get('is_visible');
            $query = $query->where('is_visible', '=', $is_visible);
        }
            
        // is_done
        if( ($request->get('is_done') != null) ){
            $is_done =  $request->get('is_done');
            $query = $query->where('is_done', '=', $is_done);
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
    
    public function changeDoneTrue(Request $request, TW $tW){
        //
        $data = array('title' => '', 'text' => '', 'type' => '', 'timer' => 3000);
        $current_user = Login::getUserData()->mail;
        $tWClone = clone $tW;
        // do process
        $twData = array(	
            'is_done' => true,
            'done_user' => $current_user,
            'status_id' => TWStatusEnum::CLOSE,
            'done_date' => DB::raw('now()')
        );
        // Start transaction!
        DB::beginTransaction();

        try {
            $updatedTW = $tWClone->update( $twData );
        }catch(\Exception $e){
            DB::rollback();
            
            $data = array(
                'title' => 'error',
                'text' => 'error',
                'type' => 'warning',
                'timer' => 3000
            );

            return Response::json( $data ); 
        }
        
        DB::commit();
        
        $data = array(
            'title' => 'success',
            'text' => 'success',
            'type' => 'success',
            'timer' => 3000
        );
        
        return Response::json( $data ); 
    }
    
    public function changeDoneFalse(Request $request, TW $tW){
        //
        $data = array('title' => '', 'text' => '', 'type' => '', 'timer' => 3000);
        $current_user = Login::getUserData()->mail;
        $tWClone = clone $tW;
        // do process
        $twData = array(	
            'is_done' => false,
            'done_user' => $current_user,
            'status_id' => TWStatusEnum::CLOSE,
            'done_date' => DB::raw('now()')
        );
        // Start transaction!
        DB::beginTransaction();

        try {
            $updatedTW = $tWClone->update( $twData );
        }catch(\Exception $e){
            DB::rollback();
            
            $data = array(
                'title' => 'error',
                'text' => 'error',
                'type' => 'warning',
                'timer' => 3000
            );

            return Response::json( $data ); 
        }
        
        DB::commit();
        
        $data = array(
            'title' => 'success',
            'text' => 'success',
            'type' => 'success',
            'timer' => 3000
        );
        
        return Response::json( $data ); 
    }
    
    public function showCreatedTW(Request $request, TW $tW){
        if(view()->exists('tw_created_show_all')){
            return View::make('tw_created_show_all');
        }
    }
    
    public function showOwneTW(Request $request, TW $tW){
        if(view()->exists('tw_owne_show_all')){
            return View::make('tw_owne_show_all');
        }
    }
    
}
