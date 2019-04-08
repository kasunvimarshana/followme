<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TW extends Model
{
    //
    // table name
    protected $table = "t_w_s";
    // primary key
    protected $primaryKey = 'id';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = array('is_visible', 'created_user', 'title', 'description', 'meeting_category_id', 'status', 'start_date', 'due_date', 'piority', 'is_done', 'done_user', 'done_date');

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
