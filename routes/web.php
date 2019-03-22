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