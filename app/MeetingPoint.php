<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingPoint extends Model
{
    //
    // table name
    protected $table = "meeting_points";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
    
    //one to many
    public function meetingAttachments(){
        return $this->hasMany('App\MeetingAttachment', 'meeting_point_id', 'id');
    }
}
