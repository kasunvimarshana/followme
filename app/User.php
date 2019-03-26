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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    public function meeting_group_users(){
        return $this->hasMany('App\meeting_group_user', 'user', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\department', 'department', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\meeting', 'user', 'id');
    }
    
    //one to many
    public function meeting_infos(){
        return $this->hasMany('App\meeting_info', 'user', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\company', 'company', 'id');
    }
    
    //one to many (inverse)
    public function user_position(){
        return $this->belongsTo('App\user_position', 'user_position', 'id');
    }
    
    //one to many
    public function meeting_attendances(){
        return $this->hasMany('App\meeting_attendance', 'user', 'id');
    }
    
    //one to many
    public function meeting_tws(){
        return $this->hasMany('App\meeting_tw', 'done_by', 'id');
    }
    
    //one to many
    public function tw_users(){
        return $this->hasMany('App\tw_user', 'user', 'id');
    }
    
    //one to many
    public function meeting_points(){
        return $this->hasMany('App\meeting_point', 'user', 'id');
    }
}
