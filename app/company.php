<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    //
    // table name
    protected $table = "companies";
    
    //one to many
    public function company_locations(){
        return $this->hasMany('App\company_location', 'company', 'id');
    }
    
    //one to many
    public function users(){
        return $this->hasMany('App\user', 'company', 'id');
    }
    
    //one to many
    public function meeting_groups(){
        return $this->hasMany('App\meeting_group', 'company', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\meeting', 'company', 'id');
    }
    
    //one to many
    public function meeting_attendances(){
        return $this->hasMany('App\meeting_attendance', 'company', 'id');
    }
}
