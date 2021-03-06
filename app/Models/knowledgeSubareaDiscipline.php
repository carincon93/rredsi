<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeSubareaDiscipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'knowledge_subarea_id',
        'name'
    ];

    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'project_knowledge_subarea_discipline', 'knowledge_subarea_discipline_id', 'project_id');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\Models\ResearchTeam', 'research_team_knowledge_subarea_discipline', 'knowledge_subarea_discipline_id', 'research_team_id');
    }

    public function educationalTools() {
        return $this->belongsToMany('App\Models\EducationalTool', 'educational_tool_knowledge_subarea_discipline', 'knowledge_subarea_discipline_id', 'educational_tool_id');
    }

    public function educationalEnvironments() {
        return $this->belongsToMany('App\Models\EducationalEnvironment', 'educational_environment_knowledge_subarea_discipline', 'knowledge_subarea_discipline_id', 'educational_environment_id');
    }

    public function knowledgeSubarea() {
        return $this->belongsTo('App\Models\KnowledgeSubarea');
    }

    public function userAcademicWorks()
    {
        return $this->hasMany('App\Models\UserAcademicWork');
    }
}
