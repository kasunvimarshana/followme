<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    //
    // table name
    protected $table = "user_positions";
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
    public function users(){
        return $this->hasMany('App\User', 'user_position_id', 'id');
    }
    
    //one to many
    public function meetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'user_position_id', 'id');
    }
}
