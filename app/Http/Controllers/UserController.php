<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Response;

class UserController extends Controller
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
        if(view()->exists('user')){
            $count = User::where('active','=','1')->count();
            return View::make('user', array('count' => $count));
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
        if(view()->exists('user_create')){
            return View::make('user_create');
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
        /*DB::transaction(function () {
            DB::table('table_1')->update(['column' => 1]);
            DB::table('table_2')->delete();
        });*/
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|min:3'
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return redirect()->route('user.create')
            ->withErrors($validator) // send back all errors to the form
            ->withInput(Input::except('password')); // send back the input so that we can repopulate the form
        } else {
            // do process
            $userData = array(	
                'id'     => Input::get('epf_no'),
                'email'     => Input::get('email'),
                'name'     => Input::get('name'),
                'password'  => Hash::make(Input::get('password')),
                'epf_no'  => Input::get('epf_no'),
                'company_id'  => Input::get('company'),
                'department_id'  => Input::get('department_id'),
                'user_position_id'  => Input::get('user_position_id'),
                'created_by'  => auth()->user()->id,
                'phone'  => Input::get('phone'),
                'status'  => '1',
                'active'  => '1'
            );
            // Start transaction!
            DB::beginTransaction();

            try {
                // Validate, then create if valid
                $newUser = User::create( $userData );
            }catch(ValidationException $e){
                // Rollback and then redirect
                // back to form with errors
                DB::rollback();
                return redirect()-route('user.create')
                //->withErrors( $e->getErrors() )
                ->withErrors( $e->getMessage() )
                ->withInput();
            }catch(\Exception $e){
                DB::rollback();
                //throw $e;
                return redirect()->route('user.create')
                //->withErrors( $e->getErrors() )
                ->withErrors( $e->getMessage() )
                ->withInput();
            }

            // If we reach here, then
            // data is valid and working.
            // Commit the queries!
            DB::commit();
            
            notify()->flash('User Created', 'success', [
                'timer' => 3000,
                'text' => 'success'
            ]);
            
            return redirect()->route('user.create');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    //other
    public function listUsers(Request $request){
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
        
        $user = new User();
        
        $query = $user->with(['company', 'department', 'userPosition'])->where('active', '=', '1');
        $recordsTotal = $query->count();
        $recordsFiltered = $recordsTotal;
            
        // get search query value
        if( ($request->get('search')) && (!empty($request->get('search'))) ){
            $search = $request->get('search');
            if( $search && (key_exists('value', $search)) ){
                $search = $search['value'];
            }
            if($search && (!empty($search))){
                //$search = (string) $search;
                $query = $query->where('email', 'like', '%' . $search . '%');
            }
        }
        
        // name
        if( ($request->get('name')) && (!empty($request->get('name'))) ){
            $name =  $request->get('name');
            $query = $query->where('name', 'like', '%' . $name . '%');
        }
        
        // email
        if( ($request->get('email')) && (!empty($request->get('email'))) ){
            $email = $request->get('email');
            $query = $query->where('email', 'like', '%' . $email . '%');
        }
        
        // epf_no
        if( ($request->get('epf_no')) && (!empty($request->get('epf_no'))) ){
            $epf_no = $request->get('epf_no');
            $query = $query->where('epf_no', 'like', '%' . $epf_no . '%');
        }
        
        // phone
        if( ($request->get('phone')) && (!empty($request->get('phone'))) ){
            $phone = $request->get('phone');
            $query = $query->where('phone', 'like', '%' . $phone . '%');
        }
        
        // user_position_id
        if( ($request->get('user_position_id')) && (!empty($request->get('user_position_id'))) ){
            $user_position_id = intval( $request->get('user_position_id') );
            $query = $query->where('user_position_id', '=', $user_position_id);
        }
        
        // department_id
        if( ($request->get('department_id')) && (!empty($request->get('department_id'))) ){
            $department_id = intval( $request->get('department_id') );
            $query = $query->where('department_id', '=', $department_id);
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
