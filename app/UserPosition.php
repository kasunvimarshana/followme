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
    
    //one to many
    public function users(){
        return $this->hasMany('App\User', 'user_position_id', 'id');
    }
    
    //one to many
    public function meetingAttendances(){
        return $this->hasMany('App\MeetingAttendance', 'user_position_id', 'id');
    }
}
