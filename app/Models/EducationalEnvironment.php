<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalEnvironment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'capacity_aprox',
        'description',
        'is_enabled',
        'is_available',
        'educational_institution_faculty_id',
    ];

    public function educationalTools() {
        return $this->hasMany('App\Models\EducationalTool');
    }

    public function educationalInstitutionFaculty() {
        return $this->belongsTo('App\Models\EducationalInstitutionFaculty');
    }
}
