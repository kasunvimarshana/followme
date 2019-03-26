<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_info extends Model
{
    //
    // table name
    protected $table = "meeting_infos";
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'user', 'id');
    }
    
    //one to many (inverse)
    public function meeting(){
        return $this->belongsTo('App\meeting', 'meeting', 'id');
    }
}
