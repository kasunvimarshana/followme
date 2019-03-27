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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'meeting_point_id', 'link_url');

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
    public function meetingPoint(){
        return $this->belongsTo('App\MeetingPoint', 'meeting_point_id', 'id');
    }
}
