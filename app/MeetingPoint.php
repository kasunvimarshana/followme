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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'user_id', 'meeting_id', 'description');

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
    public function meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
    
    //one to many
    public function meetingAttachments(){
        return $this->hasMany('App\MeetingAttachment', 'meeting_point_id', 'id');
    }
}
