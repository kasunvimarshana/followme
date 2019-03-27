<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    // table name
    protected $table = "users";
    // primary key
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id', 'epf_no', 'company_id', 'department_id', 'user_position_id', 'created_by', 'phone', 'status', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //one to many
    public function meetingGroupUsers(){
        return $this->hasMany('App\MeetingGroupUser', 'user_id', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'created_by', 'id');
    }
    
    //one to many
    public function meetingInfos(){
        return $this->hasMany('App\MeetingInfo', 'created_by', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many (inverse)
    public function userPosition(){
        return $this->belongsTo('App\UserPosition', 'user_position_id', 'id');
    }
    
    //one to many
    public function meetingAttendances(){
        return $this->hasMany('App\MeetingAttendances', 'user_id', 'id');
    }
    
    //one to many
    public function meetingTWs(){
        return $this->hasMany('App\MeetingTW', 'done_by', 'id');
    }
    
    //one to many
    public function tWUsers(){
        return $this->hasMany('App\TWUser', 'user_id', 'id');
    }
    
    //one to many
    public function meetingPoints(){
        return $this->hasMany('App\MeetingPoints', 'user_id', 'id');
    }
}
