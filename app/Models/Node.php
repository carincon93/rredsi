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
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Shuffle 4 projects for Welcome view.
     *
     * @return $projects
     */
    public function shuffleProjects() {
        $projects = collect([]);
        foreach ($this->educationalInstitutions as $educationalInstitution) {
            foreach ($educationalInstitution->researchGroups as $researchGroup) {
                foreach ($researchGroup->researchTeams as $researchTeam) {
                    foreach($researchTeam->projects as $project) {
                        $projects->add($project);
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
    public function shuffleEducationalInstitutionEvents() {
        $events = collect([]);
        foreach ($this->educationalInstitutions as $educationalInstitution) {
            foreach ($educationalInstitution->educationalInstitutionEvents as $educationalInstitutionEvent) {
                $events->add($educationalInstitutionEvent->event);
            }
        }

        return $events->take(2)->shuffle();
    }

    /**
     * Get qty projects by city for Welcome view.
     *
     * @return $qty
     */
    public function qtyProjectsByCity() {
        return DB::table('projects')->select(DB::raw('educational_institutions.city, count(educational_institutions.city)'))->join('project_research_team', 'projects.id', 'project_research_team.project_id')->join('research_teams', 'project_research_team.research_team_id', 'research_teams.id')->join('research_groups', 'research_teams.research_group_id', 'research_groups.id')->join('educational_institutions', 'research_groups.educational_institution_id', 'educational_institutions.id')->groupBy(DB::raw('educational_institutions.city'))->get();
    }
}
