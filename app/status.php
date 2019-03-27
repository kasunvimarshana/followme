<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    // table name
    protected $table = "statuses";
    // primary key
    protected $primaryKey = 'id';
}
