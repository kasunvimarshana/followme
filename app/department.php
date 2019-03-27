<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    // table name
    protected $table = "departments";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'department_id', 'id');
    }
    
    //one to many
    public function meetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'department_id', 'id');
    }
    
    //one to many
    public function users(){
        return $this->hasMany('App\User', 'department_id', 'id');
    }
}
