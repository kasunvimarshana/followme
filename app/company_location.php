<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_location extends Model
{
    //
    // table name
    protected $table = "company_locations";
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\company', 'company', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\meeting', 'company', 'id');
    }
}
