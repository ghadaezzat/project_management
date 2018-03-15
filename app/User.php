<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Task as Task;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
         'email',
          'password',
          'first_name',
          'last_name',
          'middle_name',
          'role_id',
          'city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    protected function companies(){
        return $this->hasMany('App\Comapny');

    }   
    protected function projects(){
        return $this->hasMany('App\Project');

    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
    
    protected function role(){
        return $this->belongsTo('App\Role');
    }
    public function tasks(){
        return $this->belongsToMany('Task');
    }
}
