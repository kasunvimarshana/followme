<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_attendance extends Model
{
    //
    // table name
    protected $table = "meeting_attendences";
    
    //one to many (inverse)
    public function user(){
        return $this->belongsTo('App\user', 'user', 'id');
    }
    
    //one to many (inverse)
    public function user_position(){
        return $this->belongsTo('App\user_position', 'user_position', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\company', 'company', 'id');
    }
    
    //one to many (inverse)
    public function meeting(){
        return $this->belongsTo('App\meeting', 'meeting', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\department', 'department', 'id');
    }
}
