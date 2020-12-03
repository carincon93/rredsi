<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeArea extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function researchLine() {
        return $this->hasOne('App\Models\ResearchLine');
    }

    public function academicWork() {
        return $this->hasMany('App\Models\AcademicWork');
    }

    public function knowledgeSubarea() {
        return $this->hasMany('App\Models\knowledgeSubarea');
    }

    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'project_knowledge_area', 'knowledge_area_id', 'project_id');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\Models\ResearchTeam', 'research_team_knowledge_area', 'knowledge_area_id', 'research_team_id');
    }
}
