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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'name');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = array();

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = array();
    
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
