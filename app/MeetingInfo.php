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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'meeting_id', 'created_by', 'description');

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
    public function createdUser(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    
    //one to many (inverse)
    public function Meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
}
