<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    // table name
    protected $table = "meetings";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many
    public function meetingInfos(){
        return $this->hasMany('App\MeetingInfo', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function createdUser(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    
    //one to many
    public function meetingTWs(){
        return $this->hasMany('App\MeetingTW', 'meeting_id', 'id');
    }
    
    //one to many
    public function meetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'meeting_id', 'id');
    }
    
    //one to many
    public function meetingPoints(){
        return $this->hasMany('App\MeetingPoint', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many (inverse)
    public function companyLocation(){
        return $this->belongsTo('App\CompanyLocation', 'company_location_id', 'id');
    }
    
    //one to many (inverse)
    public function meetingType(){
        return $this->belongsTo('App\MeetingType', 'meeting_type_id', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
}
