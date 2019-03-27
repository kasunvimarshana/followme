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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'company_id', 'name');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = array();

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = array();
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many
    public function meetings(){
        return $this->hasMany('App\Meeting', 'company_id', 'id');
    }
}
