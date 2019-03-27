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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'meeting_group_id', 'user_id');

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
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function meetingGroup(){
        return $this->belongsTo('App\MeetingGroup', 'meeting_group_id', 'id');
    }
}
