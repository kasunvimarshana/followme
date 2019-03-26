<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_tw extends Model
{
    //
    // table name
    protected $table = "meeting_tws";
    
    //one to many (inverse)
    public function meeting(){
        return $this->belongsTo('App\meeting', 'meeting', 'id');
    }
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'done_by', 'id');
    }
    
    //one to many
    public function tw_users(){
        return $this->hasMany('App\tw_user', 'tw_user', 'id');
    }
}
