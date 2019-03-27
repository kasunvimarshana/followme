<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingTW extends Model
{
    //
    // table name
    protected $table = "meeting_t_w_s";
    // primary key
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'meeting_id', 'description', 'is_done', 'status', 'due_date', 'done_by', 'done_date', 'piority');

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
    public function meeting(){
        return $this->belongsTo('App\Meeting', 'meeting_id', 'id');
    }
    
    //one to many (inverse)
    public function doneUser(){
        return $this->belongsTo('App\User', 'done_by', 'id');
    }
    
    //one to many
    public function tWUsers(){
        return $this->hasMany('App\TWUser', 'meeting_t_w_id', 'id');
    }
}
