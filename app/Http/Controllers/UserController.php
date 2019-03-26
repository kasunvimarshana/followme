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
    //
    public function index(){
        if(view()->exists('user')){
            $count = \App\User::where('status','=','1')->count();
            return View::make('user', array('count' => $count));
        }
    }
    
    public function showCreate(){
        if(view()->exists('user_create')){
            return View::make('user_create');
        }
    }
    
    public function doCreate(){
        
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
            return Redirect::to('config/user/create')
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
                'company'  => Input::get('company'),
                'department'  => Input::get('department'),
                'user_position'  => Input::get('user_position'),
                'created_by'  => auth()->user()->id,
                'phone'  => Input::get('phone'),
                'status'  => '1'
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
                return Redirect::to('config/user/create')
                ->withErrors( $e->getErrors() )
                ->withInput();
            }catch(\Exception $e){
                DB::rollback();
                //throw $e;
                return Redirect::to('config/user/create')
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
            
            return Redirect::to('config/user/create');
        }
        
    }
}