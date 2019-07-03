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

/*Route::get('mail', function(){
    $data = array('name'=>"kasun vimarshana");
    Mail::send(['text'=>'home'], $data, function($message) {
        $message->to('kasunV@Brandix.com', 'Tutorials Point')
            ->subject('Laravel Basic Testing Mail');
        $message->from('kasunV@Brandix.com','Virat Gandhi');
    });
});*/

/*
Route::get('mail', function(){
    
    //$toTWUsersArray = array("email" => "kasunv@brandix.com", "name" => "kasun");
    $toTWUsersArray = array("kasunv@brandix.com");
    
    Mail::to($toTWUsersArray)
        //->subject("3W")
        //->cc($toTWUsersArray)
        //->bcc($toTWUsersArray)
        ->queue(new App\Mail\TWCreateMail(App\TW::first(), App\Login::getUserData()));
});
*/

/*Route::get('event_test', function(){
    event(new App\Events\TWInfoCreateEvent(App\TWInfo::first()));
});*/

/*Route::get('event_test', function(){
    $tW = new App\TW();
    event(new App\Events\TWCloseEvent($tW->where('created_user', 'KasunV@brandix.com')->first()));
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
    Route::get('user-attachments/list', array('uses' => 'UserAttachmentController@listUserAttachments'))->name('userAttachment.list');
    Route::get('user-attachments/{userAttachment}/destroy', array('uses' => 'UserAttachmentController@destroy'))->name('userAttachment.destroy');
    Route::get('user-attachments/{userAttachment}/getFile', array('uses' => 'UserAttachmentController@getFile'))->name('userAttachment.getFile');
    Route::get('tw-infos/list', array('uses' => 'TWInfoController@listTWInfos'))->name('twInfo.list');
    Route::get('tw-infos/{tWInfo}/destroy', array('uses' => 'TWInfoController@destroy'))->name('twInfo.destroy');
    Route::get('home/tw-infos/{tWInfo}/edit', array('uses' => 'TWInfoController@edit'))->name('twInfo.edit');
    Route::post('tw-infos/{tWInfo}/edit', array('uses' => 'TWInfoController@update'))->name('twInfo.update');
    Route::get('tw-infos/{tWInfo}/getFile', array('uses' => 'TWInfoController@getFile'))->name('twInfo.getFile');
    Route::get('home/tw-infos/{tWInfo}/show', array('uses' => 'TWInfoController@show'))->name('twInfo.show');
    Route::get('home/tws/{tW}/tw-infos/create', array('uses' => 'TWInfoController@create'))->name('twInfo.create');
    Route::post('tws/{tW}/tw-infos/create', array('uses' => 'TWInfoController@store'))->name('twInfo.store');
    Route::get('home/tws/create', array('uses' => 'TWController@create'))->name('tw.create');
    Route::post('tws/create', array('uses' => 'TWController@store'))->name('tw.store');
    Route::get('users/list', array('uses' => 'UserController@listUsers'))->name('user.list');
    Route::get('users/{user}/direct-reports/list', array('uses' => 'UserController@listDirectReports'))->name('user.listDirectReports');
    Route::get('team/direct-reports/show-all', array('uses' => 'UserController@showDirectReports'))->name('user.showDirectReports');
    Route::get('team/direct-reports/{user}/show-tws', array('uses' => 'UserController@showDirectReportTW'))->name('directReport.showDirectReportTW');
    Route::get('tws/list', array('uses' => 'TWController@listTWs'))->name('tw.list');
    Route::get('tw-users/list', array('uses' => 'TWUserController@listTWUsers'))->name('twUser.list');
    Route::get('tw-users/{tWUser}/show', array('uses' => 'TWUserController@show'))->name('twUser.show');
    Route::get('tw-users/{tWUser}/destroy', array('uses' => 'TWUserController@destroy'))->name('twUser.destroy');
    Route::get('home/tws/show-created-tws', array('uses' => 'TWController@showCreatedTW'))->name('tw.showCreatedTW');
    Route::get('home/tws/show-owne-tws', array('uses' => 'TWController@showOwneTW'))->name('tw.showOwneTW');
    Route::get('tws/{tW}/destroy', array('uses' => 'TWController@destroy'))->name('tw.destroy');
    Route::get('home/tws/{tW}/edit', array('uses' => 'TWController@edit'))->name('tw.edit');
    Route::post('tws/{tW}/update', array('uses' => 'TWController@update'))->name('tw.update');
    Route::get('home/tws/{tW}/clone', array('uses' => 'TWController@showClone'))->name('tw.showClone');
    Route::post('tws/{tW}/clone', array('uses' => 'TWController@doClone'))->name('tw.doClone');
    Route::get('home/tws/{tW}/show', array('uses' => 'TWController@show'))->name('tw.show');
    Route::match(['get', 'post'], 'tws/{tW}/change-done-true', array('uses' => 'TWController@changeDoneTrue'))->name('tw.changeDoneTrue');
    Route::match(['get', 'post'], 'tws/{tW}/change-done-false', array('uses' => 'TWController@changeDoneFalse'))->name('tw.changeDoneFalse');
    Route::get('home/tws/show-all', array('uses' => 'HomeController@index'))->name('tw.showAll');
    Route::get('meeting-categories/list', array('uses' => 'MeetingCategoryController@listMeetingCategories'))->name('meetingCategory.list');
    
    Route::get('team/companies/departments/show', array('uses' => 'CompanyController@showDepartments'))->name('company.showDepartments');
    Route::get('team/departments/show', array('uses' => 'DepartmentController@showDepartments'))->name('department.show');
});

Route::group(['middleware' => 'superAdminMiddleware'], function(){
    Route::get('backstage/team/{company}/{department}/tws/show', array('uses' => 'DepartmentController@showDepartmentTW'))->name('department.showDepartmentTW');
    
    Route::get('backstage/meeting-categories/create', array('uses' => 'MeetingCategoryController@create'))->name('meetingCategory.create');
    Route::post('meeting-categories/create', array('uses' => 'MeetingCategoryController@store'))->name('meetingCategory.store');
    Route::get('backstage/meeting-categories/{meetingCategory}/edit', array('uses' => 'MeetingCategoryController@edit'))->name('meetingCategory.edit');
    Route::post('meeting-categories/{meetingCategory}/edit', array('uses' => 'MeetingCategoryController@update'))->name('meetingCategory.update');
    Route::get('backstage/user-roles/create', array('uses' => 'UserRoleController@create'))->name('userRole.create');
    Route::post('user-roles/create', array('uses' => 'UserRoleController@store'))->name('userRole.store');
    Route::match(['get', 'post'], 'user-roles/list', array('uses' => 'UserRoleController@listUserRoles'))->name('userRole.list');
    Route::get('user-roles/{userRole}/destroy', array('uses' => 'UserRoleController@destroy'))->name('userRole.destroy');
    Route::get('backstage/notification-schedules/create', array('uses' => 'NotificationScheduleController@create'))->name('notificationSchedule.create');
    
    Route::post('backstage/notification-schedules/store-schedule-tw-owner', array('uses' => 'NotificationScheduleController@storeScheduleTWOwner'))->name('notificationSchedule.storeScheduleTWOwner');
    Route::post('backstage/notification-schedules/store-schedule-hod', array('uses' => 'NotificationScheduleController@storeScheduleHOD'))->name('notificationSchedule.storeScheduleHOD');
});


