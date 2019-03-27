<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingType extends Model
{
    //
    // table name
    protected $table = "meeting_types";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'meeting_type_id', 'id');
    }
    
    //one to many
    public function meetingGroups(){
        return $this->hasMany('App\MeetingGroup', 'meeting_type_id', 'id');
    }
}
