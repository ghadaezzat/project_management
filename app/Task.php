<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'company_id','user_id','project_id','days','hours',
    ];

    protected function user(){
        return $this->belongsTo('App\User');
    }
    protected function project(){
        return $this->belongsTo('App\Project');
    }
    protected function company(){
        return $this->belongsTo('App\Company');
    }
    protected function users(){
        return $this->belongsToMany('App\User');
    }
    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
}
