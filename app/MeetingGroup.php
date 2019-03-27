<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingGroup extends Model
{
    //
    // table name
    protected $table = "meeting_groups";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function MeetingType(){
        return $this->belongsTo('App\MeetingType', 'meeting_type_id', 'id');
    }
    
    //one to many (inverse)
    public function Department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
    
    //one to many (inverse)
    public function Company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many
    public function MeetingGroupUsers(){
        return $this->hasMany('App\MeetingGroupUser', 'meeting_group_id', 'id');
    }
}
