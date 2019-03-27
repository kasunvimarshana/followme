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
