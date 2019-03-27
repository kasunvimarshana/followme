<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    // table name
    protected $table = "companies";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many
    public function companyLocations(){
        return $this->hasMany('App\CompanyLocation', 'company_id', 'id');
    }
    
    //one to many
    public function users(){
        return $this->hasMany('App\User', 'company_id', 'id');
    }
    
    //one to many
    public function meetingGroups(){
        return $this->hasMany('App\MeetingGroup', 'company_id', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'company_id', 'id');
    }
    
    //one to many
    public function meetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'company_id', 'id');
    }
}
