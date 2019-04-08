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
            $created_user = Login::getUserData()->employeenumber;
            
            $twData = array(	
                'meeting_category_id'     => Input::get('meeting_category_id'),
                'title'     => Input::get('title'),
                'due_date'     => Input::get('due_date'),
                'description'     => Input::get('description'),
                'created_user'     => $created_user
            );
            
            $twUserData = array(	
                'own_user'     => (array) Input::get('own_user')
            );
            
            // Start transaction!
            DB::beginTransaction();

            try {
                // Validate, then create if valid
                $newTW = TW::create( $twData );
            }catch(\Exception $e){
                
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
        
        $query = $tw->where('is_visible', '=', '1');
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
}
