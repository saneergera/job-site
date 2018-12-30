<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title','description', 'recruiter_id','salary'
    ];

    public function recruiters()
    {
        return $this->belongsTo('App\Recruiter');
    }

    public function applicants()
    {
        return $this->belongsToMany('App\Applicant');
    }
    
    
}
