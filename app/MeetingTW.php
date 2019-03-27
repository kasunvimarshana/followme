<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingTW extends Model
{
    //
    // table name
    protected $table = "meeting_t_w_s";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function Meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function User(){
        return $this->belongsTo('App\User', 'done_by', 'id');
    }
    
    //one to many
    public function TWUsers(){
        return $this->hasMany('App\TWUser', 'meeting_t_w_id', 'id');
    }
}
