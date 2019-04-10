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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', array('uses' => 'LoginController@showLogin'))->name('home');
// route to show the login form
Route::get('login', array('uses' => 'LoginController@showLogin'))->name('login.showLogin');
// route to process the form
Route::post('login', array('uses' => 'LoginController@doLogin'))->name('login.doLogin');
// route to procss logout
Route::get('logout', array('uses' => 'LoginController@doLogout'))->name('login.doLogout');

Route::group(['middleware' => 'memberMiddleWare'], function(){
    Route::get('home', array('uses' => 'HomeController@index'))->name('home.index');
    Route::get('home/tws/{tW}/tw-infos/create', array('uses' => 'TWInfoController@create'))->name('twInfo.create');
    Route::post('home/tws/{tW}/tw-infos/create', array('uses' => 'TWInfoController@store'))->name('twInfo.store');
    Route::get('home/tws/create', array('uses' => 'TWController@create'))->name('tw.create');
    Route::post('home/tws/create', array('uses' => 'TWController@store'))->name('tw.store');
    Route::get('users/list', array('uses' => 'UserController@listUsers'))->name('user.list');
    Route::get('tws/list', array('uses' => 'TWController@listTWs'))->name('tw.list');
    Route::get('tws/{tW}/destroy', array('uses' => 'TWController@destroy'))->name('tw.destroy');
    Route::get('tws/{tW}/change-done-true', array('uses' => 'TWController@changeDoneTrue'))->name('tw.changeDoneTrue');
    Route::get('home/tws/show-all', array('uses' => 'HomeController@index'))->name('tw.showAll');
    Route::get('meeting-categories/list', array('uses' => 'MeetingCategoryController@listMeetingCategories'))->name('meetingCategory.list');
});


