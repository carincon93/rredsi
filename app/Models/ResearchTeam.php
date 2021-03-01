<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchTeam extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mentor_name',
        'mentor_email',
        'mentor_cellphone',
        'overall_objective',
        'mission',
        'vision',
        'regional_projection',
        'knowledge_production_strategy',
        'thematic_research',
        'administrator_id',
        'research_group_id',
        'student_leader_id',
        'cretead_at'
    ];

    public function administrator() {
        return $this->belongsTo('App\Models\User', 'administrator_id');
    }

    public function researchGroup() {
        return $this->belongsTo('App\Models\ResearchGroup');
    }

    // public function studentLeader() {
    //     return $this->belongsTo('App\Models\Student');
    // }

    public function academicPrograms() {
        return $this->belongsToMany('App\Models\AcademicProgram', 'research_team_academic_program', 'research_team_id', 'academic_program_id');
    }

    public function researchLines() {
        return $this->belongsToMany('App\Models\ResearchLine', 'research_team_research_line', 'research_team_id', 'research_line_id');
    }

    public function knowledgeSubareaDisciplines() {
        return $this->belongsToMany('App\Models\KnowledgeSubareaDiscipline', 'research_team_knowledge_subarea_discipline', 'research_team_id', 'knowledge_subarea_discipline_id');
    }

    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'project_research_team', 'research_team_id', 'project_id')
            ->withPivot([
                'is_principal',
            ]);
    }

    public function members() {
        return $this->belongsToMany('App\Models\User','research_team_members')
            ->withPivot([
                'comment',
                'accepted_at',
                'retired_at',
                'is_external',
                'authorization_letter',
            ]);
    }
}
