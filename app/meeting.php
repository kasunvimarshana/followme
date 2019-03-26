<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting extends Model
{
    //
    // table name
    protected $table = "meetings";
    
    //one to many
    public function meeting_infos(){
        return $this->hasMany('App\meeting_info', 'meeting_info', 'id');
    }
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'created_by', 'id');
    }
    
    //one to many
    public function meeting_tws(){
        return $this->hasMany('App\meeting_tw', 'is_done', 'id');
    }
    
    //one to many
    public function meeting_attendances(){
        return $this->hasMany('App\meeting_attendance', 'user', 'id');
    }
    
    //one to many
    public function meeting_points(){
        return $this->hasMany('App\meeting_point', 'user', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\company', 'company', 'id');
    }
    
    //one to many (inverse)
    public function company_location(){
        return $this->belongsTo('App\company_location', 'company_location', 'id');
    }
    
    //one to many (inverse)
    public function meeting_type(){
        return $this->belongsTo('App\meeting_type', 'meeting_type', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\department', 'department', 'id');
    }
}