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
    public function MeetingInfos(){
        return $this->hasMany('App\MeetingInfo', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function User(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    
    //one to many
    public function MeetingTWs(){
        return $this->hasMany('App\MeetingTW', 'meeting_id', 'id');
    }
    
    //one to many
    public function MeetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'meeting_id', 'id');
    }
    
    //one to many
    public function MeetingPoints(){
        return $this->hasMany('App\MeetingPoint', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function Company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many (inverse)
    public function CompanyLocation(){
        return $this->belongsTo('App\CompanyLocation', 'company_location_id', 'id');
    }
    
    //one to many (inverse)
    public function MeetingType(){
        return $this->belongsTo('App\MeetingType', 'meeting_type_id', 'id');
    }
    
    //one to many (inverse)
    public function Department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
}
