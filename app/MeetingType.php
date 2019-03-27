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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'name');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = array();

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = array();
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'meeting_type_id', 'id');
    }
    
    //one to many
    public function meetingGroups(){
        return $this->hasMany('App\MeetingGroup', 'meeting_type_id', 'id');
    }
}
