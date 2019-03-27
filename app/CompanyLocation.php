<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    //
    // table name
    protected $table = "company_locations";
    // primary key
    protected $primaryKey = 'id';
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'company_id', 'id');
    }
}
