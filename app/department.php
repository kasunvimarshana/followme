<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    //
    // table name
    protected $table = "departments";
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\meeting', 'meeting', 'id');
    }
    
    //one to many
    public function meeting_attendences(){
        return $this->hasMany('App\meeting_attendence', 'meeting_attendance', 'id');
    }
    
    //one to many
    public function users(){
        return $this->hasMany('App\user', 'user', 'id');
    }
}
