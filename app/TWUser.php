<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TWUser extends Model
{
    //
    // table name
    protected $table = "t_w_users";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function MeetingTW(){
        return $this->belongsTo('App\MeetingTW', 'meeting_t_w_id', 'id');
    }
}
