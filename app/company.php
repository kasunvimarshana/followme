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
    public function CompanyLocations(){
        return $this->hasMany('App\CompanyLocation', 'company_id', 'id');
    }
    
    //one to many
    public function Users(){
        return $this->hasMany('App\User', 'company_id', 'id');
    }
    
    //one to many
    public function MeetingGroups(){
        return $this->hasMany('App\MeetingGroup', 'company_id', 'id');
    }
    
    //one to many
    public function Meetings(){
        return $this->hasMany('App\Meeting', 'company_id', 'id');
    }
    
    //one to many
    public function MeetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'company_id', 'id');
    }
}
