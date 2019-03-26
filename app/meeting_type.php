<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_type extends Model
{
    //
    // table name
    protected $table = "meeting_types";
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\meeting', 'meeting', 'id');
    }
    
    //one to many
    public function meeting_groups(){
        return $this->hasMany('App\meeting_group', 'meeting_group', 'id');
    }
}
