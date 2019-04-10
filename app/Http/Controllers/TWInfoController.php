<?php

namespace App\Http\Controllers;

use App\TWInfo;
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
use App\Enums\Status;
use App\Enums\TWMeta;
use App\TWUser;
use App\User;
use App\TW;
use App\UserAttachment;
use Storage;

class TWInfoController extends Controller
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
    public function create(Request $request, TW $tW)
    {
        //
        if(view()->exists('tw_info_create')){
            return View::make('tw_info_create', ['tW' => $tW]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TW $tW)
    {
        //
        $data = array('title' => '', 'text' => '', 'type' => '', 'timer' => 3000);
        // do process
        $current_user = Login::getUserData()->mail;
        $twResourceDir = $tW->resource_dir;

        $twInfoData = array(	
            'is_visible' => 1,
            't_w_id' => $tW->id,
            'description' => Input::get('description'),
            'created_user' => $current_user
        );

        $userAttachmentData = (array) $request->file('var_user_attachment');

        // Start transaction!
        DB::beginTransaction();

        try {
            //create directory
            if(!Storage::exists($twResourceDir)) {
                Storage::makeDirectory($twResourceDir, 0775, true); //creates directory
            }
            // Validate, then create if valid
            
            $newTWInfo = TWInfo::create( $twInfoData );

            if( $request->hasFile('var_user_attachment') ){
                foreach($userAttachmentData as $key => $value){
                    $file_original_name = $value->getClientOriginalName();
                    $filename = $value->store( $twResourceDir );
                    $newUserAttachment = UserAttachment::create(array(
                        'is_visible' => 1,
                        'attached_by' => $current_user,
                        'file_original_name' => $file_original_name,
                        'attachable_type' => get_class( $newTWInfo ),
                        'attachable_id' => $newTWInfo->id,
                        'file_type' => null,
                        'link_url' => $filename
                    ));
                }
            }
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

    /**
     * Display the specified resource.
     *
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function show(TWInfo $tWInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(TWInfo $tWInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TWInfo $tWInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TWInfo  $tWInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TWInfo $tWInfo)
    {
        //
    }
}
