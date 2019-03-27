<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingAttendance extends Model
{
    //
    // table name
    protected $table = "meeting_attendences";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function UserPosition(){
        return $this->belongsTo('App\UserPosition', 'user_position_id', 'id');
    }
    
    //one to many (inverse)
    public function Company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many (inverse)
    public function Meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function Department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
}
