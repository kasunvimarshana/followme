<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingGroup extends Model
{
    //
    // table name
    protected $table = "meeting_groups";
    // primary key
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('active', 'meeting_type_id', 'company_id', 'department_id', 'name', 'description');

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
    public function meetingType(){
        return $this->belongsTo('App\MeetingType', 'meeting_type_id', 'id');
    }
    
    //one to many (inverse)
    public function department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
    
    //one to many (inverse)
    public function company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    //one to many
    public function meetingGroupUsers(){
        return $this->hasMany('App\MeetingGroupUser', 'meeting_group_id', 'id');
    }
}
