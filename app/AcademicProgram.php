<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicProgram extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'academic_level',
        'modality',
        'daytime',
        'start_date',
        'end_date',
        'educational_institution_id',
    ];

    public function educationalInstitution() {
        return $this->belongsTo('App\EducationalInstitution');
    }

    public function graduation() {
        return $this->hasOne('App\Graduation');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\ResearchTeam', 'research_team_academic_program', 'academic_program_id', 'research_team_id');
    }

    public function projects() {
        return $this->belongsToMany('App\Project', 'project_academic_program', 'academic_program_id', 'project_id');
    }
}
