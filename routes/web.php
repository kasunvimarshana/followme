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
    // default
    // rout to main page
    Route::get('config', array('uses' => 'ConfigController@index'))->name('config.index');
    // meeting type
    // route to meeting type page
    Route::get('config/meeting-types', array('uses' => 'MeetingTypeController@index'))->name('meetingType.index');
    Route::get('meeting-types/list', array('uses' => 'MeetingTypeController@listMeetingTypes'))->name('meetingType.list');
    Route::get('config/meeting-types/create', array('uses' => 'MeetingTypeController@create'))->name('meetingType.create');
    Route::post('config/meeting-types/create', array('uses' => 'MeetingTypeController@store'))->name('meetingType.store');
    // meeting group
    // route to meeting group page
    Route::get('config/meeting-groups', array('uses' => 'MeetingGroupController@index'))->name('meetingGroup.index');
    Route::get('meeting-groups/list', array('uses' => 'MeetingGroupController@listMeetingGroups'))->name('meetingGroup.list');
    Route::get('config/meeting-groups/create', array('uses' => 'MeetingGroupController@create'))->name('meetingGroup.create');
    Route::post('config/meeting-groups/create', array('uses' => 'MeetingGroupController@store'))->name('meetingGroup.store');
    // meting
    // route to meeting page
    Route::get('meetings', array('uses' => 'MeetingController@index'))->name('meeting.index');
    // tw
    // route to tw page
    Route::get('meetings/tws', array('uses' => 'MeetingTWController@index'))->name('meetingTW.index');
    // user position
    Route::get('user-positions/list', array('uses' => 'UserPositionController@listUserPositions'))->name('userPosition.list');
    // user
    // route to user page
    Route::get('config/users', array('uses' => 'UserController@index'))->name('user.index');
    // route to user list page
    Route::get('config/users/list', array('uses' => 'UserController@index'))->name('user.list');
    // user create page
    Route::get('config/users/create', array('uses' => 'UserController@create'))->name('user.create');
    // route to process create user
    Route::post('config/users/create', array('uses' => 'UserController@store'))->name('user.store');
    // route to process edit user
    Route::post('config/users/edit', array('uses' => 'UserController@edit'))->name('user.edit');
    Route::get('config/users/show-users', array('uses' => 'UserController@showUsers'))->name('user.showUsers');
    // department
    // route to department page
    Route::get('config/departments', array('uses' => 'DepartmentController@index'))->name('department.index');
    Route::get('departments/list', array('uses' => 'DepartmentController@listDepartments'))->name('department.list');
    Route::get('config/departments/create', array('uses' => 'DepartmentController@create'))->name('department.create');
    Route::post('config/departments/create', array('uses' => 'DepartmentController@store'))->name('department.store');
    // company location
    // route to location page
    Route::get('config/company-locations', array('uses' => 'CompanyLocationController@index'))->name('companyLocation.index');
    Route::get('company-locations/list', array('uses' => 'CompanyLocationController@listCompanyLocations'))->name('companyLocation.list');
    Route::get('config/company-locations/create', array('uses' => 'CompanyLocationController@create'))->name('companyLocation.create');
    Route::post('config/company-locations/create', array('uses' => 'CompanyLocationController@store'))->name('companyLocation.store');
    
});