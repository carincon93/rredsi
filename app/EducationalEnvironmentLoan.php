<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalEnvironmentLoan extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'educational_environment_id',
    ];

    public function loan() {
        return $this->belongsTo('App\Loan', 'id');
    }

    public function educationalEnvironment() {
        return $this->belongsTo('App\EducationalEnvironment');
    }
}
