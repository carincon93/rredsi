<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchGroup extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'leader',
        'gruplac',
        'minciencias_code',
        'minciencias_category',
        'website',
        'educational_institution_faculty_id',
    ];

    public function educationalInstitutionFaculty() {
        return $this->belongsTo('App\Models\EducationalInstitutionFaculty');
    }

    public function researchTeams() {
        return $this->hasMany('App\Models\ResearchTeam');
    }

    public function researchLines() {
        return $this->hasMany('App\Models\ResearchLine');
    }

    public function academicWorks() {
        return $this->hasMany('App\Models\AcademicWork');
    }
}
