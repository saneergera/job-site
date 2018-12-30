<?php

namespace App;

use Laravel\Passport\HasApiTokens;
;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;

Relation::morphMap([
    'applicant' => 'App\Applicant',
    'recruiter' => 'App\Recruiter'
]);

class User extends Authenticatable
{
    use HasApiTokens ,Notifiable;

   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','ownerable_type','ownerable_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   

    public function ownerable(){
     return $this->morphTo();   
    }

  


}
