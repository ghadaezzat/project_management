<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //to prevent mass assignment laravel uses the fillable array.
    protected $fillable = [
        'name', 'description', 'company_id','user_id','days',
    ];
    protected function user(){
        return $this->belongsTo('App\User');
    }
   
    protected function company(){
        return $this->belongsTo('App\Company');
    }
     public function comments(){
         return $this->morphMany('App\Comment','commentable');
     }
}
