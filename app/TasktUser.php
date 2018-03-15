<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasktUser extends Model
{
    //
    protected $fillable = [
         'task_id','user_id',
    ];
}
