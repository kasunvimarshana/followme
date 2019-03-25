<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/admin', 'UserController@home_1');
    Route::get('/user', 'UserController@home_2');
});
*/

Route::get('/', array('uses' => 'LoginController@showLogin'));
// route to show the login form
Route::get('login', array('uses' => 'LoginController@showLogin'));
// route to process the form
Route::post('login', array('uses' => 'LoginController@doLogin'));
// route to procss logout
Route::get('logout', array('uses' => 'LoginController@doLogout'));

// route group for auth users
Route::group(['middleware' => 'memberMiddleWare'], function(){
    //Route::match(['get', 'post'], '/memberOnlyPage/', 'HomeController@index');
    
    // rout to main page
    Route::get('config', array('uses' => 'ConfigController@index'));
    // route to user page
    Route::get('config/user', array('uses' => 'UserController@index'));
    // route to department page
    Route::get('config/department', array('uses' => 'DepartmentController@index'));
    // route to location page
    Route::get('config/location', array('uses' => 'CompanyLocationController@index'));
    // route to meeting type page
    Route::get('config/meeting_type', array('uses' => 'MeetingTypeController@index'));
    // route to meeting group page
    Route::get('config/meeting_group', array('uses' => 'MeetingGroupController@index'));
});