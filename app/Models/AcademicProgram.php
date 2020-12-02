<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AcademicProgram extends Model
{
    use HasFactory;
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

    protected $appends = ['datesForHumans'];

    public function educationalInstitution() {
        return $this->belongsTo('App\Models\EducationalInstitution');
    }

    public function userGraduation() {
        return $this->hasOne('App\Models\UserGraduation');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\Models\ResearchTeam', 'research_team_academic_program', 'academic_program_id', 'research_team_id');
    }

    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'project_academic_program', 'academic_program_id', 'project_id');
    }

    public function getDatesForHumansAttribute() 
    {
        $start_date = Carbon::parse($this->start_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        $end_date   = Carbon::parse($this->end_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        return "Del $start_date al $end_date";
    }
}
