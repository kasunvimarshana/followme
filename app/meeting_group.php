<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_group extends Model
{
    //
    // table name
    protected $table = "meeting_groups";
    
    //one to many (inverse)
    public function meeting_type(){
        return $this->belongsTo('App\meeting_type', 'meeting_type', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\department', 'department', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\company', 'company', 'id');
    }
    
    //one to many
    public function meeting_group_users(){
        return $this->hasMany('App\meeting_group_user', 'meeting_group', 'id');
    }
}
