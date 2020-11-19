<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchLine extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'objectives',
        'mission',
        'vision',
        'achievements',
        'knowledge_area_id',
        'research_group_id',
    ];

    public function knowledgeArea() {
        return $this->belongsTo('App\KnowledgeArea');
    }

    public function researchGroup() {
        return $this->belongsTo('App\ResearchGroup');
    }

    public function projects() {
        return $this->belongsToMany('App\Project', 'project_research_line', 'research_line_id', 'project_id');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\ResearchTeam', 'research_team_research_line', 'research_line_id', 'research_team_id');
    }
}
