<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_user extends Model
{
    //
    // table name
    protected $table = "tw_users";
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'user', 'id');
    }
    
    //one to many (inverse)
    public function meeting_tw(){
        return $this->belongsTo('App\meeting_tw', 'meeting_tw', 'id');
    }
}
