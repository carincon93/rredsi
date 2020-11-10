<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'is_returned',
        'is_accepted',
        'justification',
        'authorization_letter',
        'annotation',
        'returned_at',
        'accepted_at',
        'project_id',
    ];

    public function educationalEnvironmentLoan() {
        return $this->hasOne('App\EducationalEnvironmentLoan', 'id');
    }

    public function educationalToolLoan() {
        return $this->hasOne('App\EducationalToolLoan', 'id');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }
}
