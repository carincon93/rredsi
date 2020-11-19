<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalTool extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'qty',
        'is_available',
        'is_enabled',
        'educational_environment_id',
    ];

    public function educationalEnvironment() {
        return $this->belongsTo('App\EducationalEnvironment');
    }

    public function educationalToolLoan() {
        return $this->hasOne('App\EducationalToolLoan');
    }
}
