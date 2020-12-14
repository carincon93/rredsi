<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInstitutionFaculty extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'educational_institution_id',
        'name',
        'email',
        'phone_number',
        'ext'
    ];

    public function educationalInstitution() {
        return $this->belongsTo('App\Models\EducationalInstitution');
    }

    public function academicPrograms() {
        return $this->hasMany('App\Models\AcademicProgram');
    }

    public function researchGroups() {
        return $this->hasMany('App\Models\ResearchGroup');
    }

    public function educationalEnvironments() {
        return $this->hasMany('App\Models\EducationalEnvironment');
    }

    public function members() {
        return $this->belongsToMany('App\Models\User', 'educational_institution_faculty_members', 'educational_institution_faculty_id', 'user_id')
            ->withPivot([
                'is_principal'
            ]);
    }
}
