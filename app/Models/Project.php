<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    public static $projects;

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'abstract',
        'keywords',
        'file',
        'overall_objective',
        'is_privated',
        'is_published',
        'roles_requirements_description',        
        'roles_requirements',
        'tools_requirements_description',        
        'tools_requirements',
        'project_type_id',
    ];

    protected $appends = ['datesForHumans'];

    public function researchOutputs() {
        return $this->hasMany('App\Models\ResearchOutput');
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

    public function getDatesForHumansAttribute() {
        $start_date = Carbon::parse($this->start_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        $end_date   = Carbon::parse($this->end_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        return "Del $start_date al $end_date";
    }

    public function scopeSearchProjects($query, $titleOrKeyword) {
        $titleOrKeyword = mb_strtolower($titleOrKeyword);
        return $query->select('projects.*', 'project_types.type')
            ->join('project_types', 'projects.project_type_id', 'project_types.id')
            ->join('project_knowledge_subarea_discipline', 'projects.id', 'project_knowledge_subarea_discipline.project_id')
            ->join('knowledge_subarea_disciplines', 'project_knowledge_subarea_discipline.knowledge_subarea_discipline_id', 'knowledge_subarea_disciplines.id')
            ->join('knowledge_subareas', 'knowledge_subarea_disciplines.knowledge_subarea_id', 'knowledge_subareas.id')
            ->join('knowledge_areas', 'knowledge_subareas.knowledge_area_id', 'knowledge_areas.id')
            ->whereRaw('lower(projects.title) LIKE (?)', "%$titleOrKeyword%")
            ->orWhereRaw('(select lower(jsonb_array_elements_text(projects.keywords::jsonb))) LIKE (?)', "%$titleOrKeyword%")
            ->orWhereRaw('lower(knowledge_areas.name) LIKE (?)', "%$titleOrKeyword%")
            ->where('projects.is_privated', 0)
            ->orWhere('project_types.type', $titleOrKeyword);
    }

    public function scopeAllKeywords($query, $node) {
        $allKeyWords = collect([]);
        
        foreach ($node->educationalInstitutions as $educationalInstitution) {
            foreach ($educationalInstitution->researchGroups as $researchGroup) {
                foreach ($researchGroup->researchTeams as $researchTeam) {
                    foreach ($researchTeam->projects as $project) {
                        foreach (json_decode($project->keywords) as $keywords){ 
                            foreach (explode(',', $keywords) as $keyword) {
                                $allKeyWords->push(trim($keyword)); 
                            }
                        }
                    }
                }

            }
        }

        return $allKeyWords->filter()->unique();
    }
}
