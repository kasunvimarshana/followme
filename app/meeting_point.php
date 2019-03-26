<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_point extends Model
{
    //
    // table name
    protected $table = "meeting_points";
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'user', 'id');
    }
    
    //one to many (inverse)
    public function meeting(){
        return $this->belongsTo('App\meeting', 'meeting', 'id');
    }
    
    //one to many
    public function meeting_attachments(){
        return $this->hasMany('App\meeting_attachment', 'meeting_point', 'id');
    }
}
