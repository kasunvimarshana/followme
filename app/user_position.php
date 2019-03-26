<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_position extends Model
{
    //
    // table name
    protected $table = "user_positions";
    
    //one to many
    public function users(){
        return $this->hasMany('App\user', 'user_position', 'id');
    }
    
    //one to many
    public function meeting_attendances(){
        return $this->hasMany('App\meeting_attendance', 'user_position', 'id');
    }
}
