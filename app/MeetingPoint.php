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
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function Meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
    
    //one to many
    public function MeetingAttachments(){
        return $this->hasMany('App\MeetingAttachment', 'meeting_point_id', 'id');
    }
}
