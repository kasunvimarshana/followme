<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting_attachment extends Model
{
    //
    // table name
    protected $table = "meeting_attachments";
    
    //one to many (inverse)
    public function meeting_point(){
        return $this->belongsTo('App\meeting_point', 'meeting_point', 'id');
    }
}
