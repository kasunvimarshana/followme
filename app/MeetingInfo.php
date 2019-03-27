<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingInfo extends Model
{
    //
    // table name
    protected $table = "meeting_infos";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function createdUser(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    
    //one to many (inverse)
    public function Meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
}
