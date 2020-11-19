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
        'educational_institution_id',
    ];

    public function educationalInstitution() {
        return $this->belongsTo('App\EducationalInstitution');
    }

    public function researchTeams() {
        return $this->hasMany('App\ResearchTeam');
    }

    public function researchLines() {
        return $this->hasMany('App\ResearchLine');
    }

    public function academicWorks() {
        return $this->hasMany('App\AcademicWork');
    }
}
