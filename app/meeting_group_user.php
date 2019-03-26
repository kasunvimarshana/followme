<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_group_user extends Model
{
    //
    // table name
    protected $table = "meeting_group_users";
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'user', 'id');
    }
    
    //one to many (inverse)
    public function meeting_group(){
        return $this->belongsTo('App\meeting_group', 'meeting_group', 'id');
    }
}
