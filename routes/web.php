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

Route::get('/', array('uses' => 'LoginController@showLogin'))->name('home');
// route to show the login form
Route::get('login', array('uses' => 'LoginController@showLogin'))->name('login.showLogin');
// route to process the form
Route::post('login', array('uses' => 'LoginController@doLogin'))->name('login.doLogin');
// route to procss logout
Route::get('logout', array('uses' => 'LoginController@doLogout'))->name('login.doLogout');

// route group for auth users
Route::group(['middleware' => 'memberMiddleWare'], function(){
    //Route::match(['get', 'post'], '/memberOnlyPage/', 'HomeController@index');
    
    // rout to main page
    Route::get('config', array('uses' => 'ConfigController@index'))->name('config.index');
    // route to user page
    Route::get('config/users', array('uses' => 'UserController@index'))->name('user.index');
    // route to user list page
    Route::get('config/users/list', array('uses' => 'UserController@index'))->name('user.list');
    // route to department page
    Route::get('config/departments', array('uses' => 'DepartmentController@index'))->name('department.index');
    // route to location page
    Route::get('config/locations', array('uses' => 'CompanyLocationController@index'))->name('companyLocation.index');
    // route to meeting type page
    Route::get('config/meeting-types', array('uses' => 'MeetingTypeController@index'))->name('meetingType.index');
    // route to meeting group page
    Route::get('config/meeting-groups', array('uses' => 'MeetingGroupController@index'))->name('meetingGroup.index');
    // route to meeting group page
    Route::get('meetings', array('uses' => 'MeetingController@index'))->name('meeting.index');
    // route to meeting group page
    Route::get('meetings/tws', array('uses' => 'MeetingTWController@index'))->name('meetingTW.index');
    // user create page
    Route::get('config/users/create', array('uses' => 'UserController@create'))->name('user.create');
    // route to process create user
    Route::post('config/users/create', array('uses' => 'UserController@store'))->name('user.store');
    // route to process edit user
    Route::post('config/users/edit', array('uses' => 'UserController@edit'))->name('user.edit');
});