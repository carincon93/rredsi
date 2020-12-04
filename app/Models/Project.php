<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_type_id',
        'title',
        'start_date',
        'end_date',
        'abstract',
        'keywords',
        'file',
        'overall_objective',
        'is_privated',
        'is_published',
    ];

    protected $appends = ['datesForHumans'];

    public function researchOutputs() {
        return $this->hasMany('App\Models\ResearchOutput');
    }

    public function loans() {
        return $this->hasMany('App\Models\Loan');
    }

    public function knowledgeSubareaDisciplines() {
        return $this->belongsToMany('App\Models\KnowledgeSubareaDiscipline', 'project_knowledge_subarea_discipline', 'project_id', 'knowledge_subarea_discipline_id');
    }

    public function events() {
        return $this->belongsToMany('App\Models\Event', 'event_project', 'project_id', 'event_id');
    }

    public function researchLines() {
        return $this->belongsToMany('App\Models\ResearchLine', 'project_research_line', 'project_id', 'research_line_id');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\Models\ResearchTeam', 'project_research_team', 'project_id', 'research_team_id')
            ->withPivot([
                'is_principal',
            ]);
    }

    public function academicPrograms() {
        return $this->belongsToMany('App\Models\AcademicProgram', 'project_academic_program', 'project_id', 'academic_program_id');
    }


    public function authors() {
        return $this->belongsToMany('App\Models\User', 'authors', 'project_id', 'user_id');
    }

    public function projectType() {
        return $this->belongsTo('App\Models\ProjectType');
    }

    public function getDatesForHumansAttribute()
    {
        $start_date = Carbon::parse($this->start_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        $end_date   = Carbon::parse($this->end_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        return "Del $start_date al $end_date";
    }
}
