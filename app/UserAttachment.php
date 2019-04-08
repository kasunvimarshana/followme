<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttachment extends Model
{
    //
    // table name
    protected $table = "user_attachments";
    // primary key
    protected $primaryKey = 'id';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = array('is_visible', 'attached_by', 'attachable_type', 'attachable_id', 'file_type', 'link_url');

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
}
