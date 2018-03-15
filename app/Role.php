<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    protected function users(){
        return $this->hasMany('App\User');

    }
}


