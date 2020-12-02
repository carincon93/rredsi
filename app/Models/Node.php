<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function shuffleEducationalInstitutionEvents() {
        $events = collect([]);
        foreach ($this->educationalInstitutions as $educationalInstitution) {
            foreach ($educationalInstitution->educationalInstitutionEvents as $educationalInstitutionEvent) {
                $events->add($educationalInstitutionEvent->event);
            }
        }

        return $events->take(2)->shuffle();
    }
}
