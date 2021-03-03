<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Node extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
        'administrator_id',
    ];

    public function educationalInstitutions() {
        return $this->hasMany('App\Models\EducationalInstitution');
    }

    public function administrator() {
        return $this->belongsTo('App\Models\User', 'administrator_id');
    }

    public function nodeEvents() {
        return $this->hasMany('App\Models\NodeEvent');
    }

    /**
     * Shuffle 4 projects for Welcome view.
     *
     * @return $projects
     */
    public function shuffleProjects() {
        $projects = collect([]);
        foreach ($this->educationalInstitutions as $educationalInstitution) {
            foreach ($educationalInstitution->educationalInstitutionFaculties as $educationalInstitutionFaculty) {
                foreach ($educationalInstitutionFaculty->researchGroups as $researchGroup) {
                    foreach ($researchGroup->researchTeams as $researchTeam) {
                        foreach($researchTeam->projects as $project) {
                            $projects->add($project);
                        }
                    }
                }
            }
        }

        return $projects->where('is_privated', 0)->take(4)->shuffle();
    }

    /**
     * Shuffle 2 educational institution events for Welcome view.
     *
     * @return $events
     */

    public function educationalInstitutionAndNodeEvents($knowledgeSubareaDiscipline = null) {
        $events = collect([]);
        $knowledgeSubareaDiscipline = mb_strtolower($knowledgeSubareaDiscipline);

        foreach ($this->educationalInstitutions as $educationalInstitution) {
            foreach ($educationalInstitution->educationalInstitutionEvents as $educationalInstitutionEvent) {
                if ($educationalInstitutionEvent->event->start_date > date('Y-m-d')) {
                    $events->add($educationalInstitutionEvent->event);
                }
            }
        }

        foreach ($this->nodeEvents as $nodeEvent) {
            if ($nodeEvent->event->start_date > date('Y-m-d')) {
                $events->add($nodeEvent->event);
            }
        }

        if ($knowledgeSubareaDiscipline) {
            return $events->map(function ($event) use($knowledgeSubareaDiscipline) {
                return $event->whereHas('knowledgeSubareaDisciplines', function($query) use($knowledgeSubareaDiscipline) {
                    return $query->whereRaw('lower(knowledge_subarea_disciplines.name) LIKE (?)', "%$knowledgeSubareaDiscipline%");
                })->get();
            })->unique()->flatten();
        }

        return $events;
    }

    /**
     * Get qty projects by city for Welcome view.
     *
     * @return $qty
     */
    public function qtyProjectsByCity() {
        return DB::table('projects')->select(DB::raw('educational_institutions.city, count(educational_institutions.city)'))->join('project_research_team', 'projects.id', 'project_research_team.project_id')->join('research_teams', 'project_research_team.research_team_id', 'research_teams.id')->join('research_groups', 'research_teams.research_group_id', 'research_groups.id')->join('educational_institution_faculties', 'research_groups.educational_institution_faculty_id', 'educational_institution_faculties.id')->join('educational_institutions', 'educational_institution_faculties.educational_institution_id', 'educational_institutions.id')->groupBy(DB::raw('educational_institutions.city'))->get();
    }
}
