<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingAttachment extends Model
{
    //
    // table name
    protected $table = "meeting_attachments";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function MeetingPoint(){
        return $this->belongsTo('App\MeetingPoint', 'meeting_point_id', 'id');
    }
}
