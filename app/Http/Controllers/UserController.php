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
            return Redirect::to('config/users/create')
            ->withErrors($validator) // send back all errors to the form
            ->withInput(Input::except('password')); // send back the input so that we can repopulate the form
        } else {
            // do process
            $userdata = array(	
                'id'     => Input::get('epf_no'),
                'email'     => Input::get('email'),
                'name'     => Input::get('name'),
                'password'  => Hash::make(Input::get('password')),
                'epf_no'  => Input::get('epf_no'),
                'company_id'  => Input::get('company'),
                'department_id'  => Input::get('department'),
                'user_position_id'  => Input::get('user_position'),
                'created_by'  => auth()->user()->id,
                'phone'  => Input::get('phone'),
                'status'  => '1',
                'active'  => '1'
            );
            // Start transaction!
            DB::beginTransaction();

            try {
                // Validate, then create if valid
                $newUser = User::create( $userdata );
            }catch(ValidationException $e){
                // Rollback and then redirect
                // back to form with errors
                DB::rollback();
                return Redirect::to('config/users/create')
                ->withErrors( $e->getErrors() )
                ->withInput();
            }catch(\Exception $e){
                DB::rollback();
                //throw $e;
                return Redirect::to('config/users/create')
                ->withErrors( $e->getErrors() )
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
            
            return Redirect::to('config/users/create');
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
}
