<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id',
    ];

    public function user(){

        return $this->morphOne('App\User','ownerable');

    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }



}
