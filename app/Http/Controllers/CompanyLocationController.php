<?php

namespace App\Http\Controllers;

use App\CompanyLocation;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use DB;
use Illuminate\Database\QueryException;
use \Response;

class CompanyLocationController extends Controller
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
        if(view()->exists('company_location')){
            $count = CompanyLocation::where('active','=','1')->count();
            return View::make('company_location', array('count' => $count));
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
        if(view()->exists('company_location_create')){
            return View::make('company_location_create');
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
        $companyLocationData = array(	
            'name'     => Input::get('name'),
            'active'  => '1'
        );
        // Start transaction!
        DB::beginTransaction();

        try {
            // Validate, then create if valid
            $newCompanyLocation = CompanyLocation::create( $companyLocationData );
        }catch(ValidationException $e){
            // Rollback and then redirect
            // back to form with errors
            DB::rollback();
            return redirect()->route('companyLocation.create')
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }catch(\Exception $e){
            DB::rollback();
            //throw $e;
            return redirect()->route('companyLocation.create')
            //->withErrors( $e->getErrors() )
            ->withErrors( $e->getMessage() )
            ->withInput();
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        notify()->flash('Location Created', 'success', [
            'timer' => 3000,
            'text' => 'success'
        ]);

        return redirect()->route('companyLocation.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyLocation $companyLocation)
    {
        //
    }
    
    //other
    public function listCompanyLocations(Request $request){
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
        
        $companyLocation = new CompanyLocation();
        
        $query = $companyLocation->where('active', '=', '1');
        $recordsTotal = $query->count();
        $recordsFiltered = $recordsTotal;
            
        // get search query value
        if( $request->get('search') && !empty($request->get('search')) ){
            $search = (string) $request->get('search');
            $query = $query->where('name', 'like', '%' . $search . '%');
            $recordsFiltered = $query->count();
        }
        
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
