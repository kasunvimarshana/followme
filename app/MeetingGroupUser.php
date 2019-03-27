<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingGroupUser extends Model
{
    //
    // table name
    protected $table = "meeting_group_users";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function MeetingGroup(){
        return $this->belongsTo('App\MeetingGroup', 'meeting_group_id', 'id');
    }
}
