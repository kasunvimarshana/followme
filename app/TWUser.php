<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TWUser extends Model
{
    //
    // table name
    protected $table = "t_w_users";
    // primary key
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'meeting_t_w_id', 'user_id');

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
    public function meetingTW(){
        return $this->belongsTo('App\MeetingTW', 'meeting_t_w_id', 'id');
    }
}
