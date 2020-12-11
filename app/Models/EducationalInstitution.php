<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EducationalInstitution extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nit',
        'address',
        'city',
        'phone_number',
        'website',
        'administrator_id',
        'node_id',
    ];

    public function node() {
        return $this->belongsTo('App\Models\Node');
    }

    public function educationalInstitutionEvents() {
        return $this->hasMany('App\Models\EducationalInstitutionEvent');
    }

    public function educationalInstitutionFaculties() {
        return $this->hasMany('App\Models\EducationalInstitutionFaculty');
    }

    public function administrator() {
        return $this->belongsTo('App\Models\User');
    }

    // Business Analytics
    public function projectsByKnowledgeArea() {
        $industriasCreativas = 0;
        $cienciasNaturales = 0;
        $ingenieriaTecnologia = 0;
        $cuartaRevolucionIndustrial = 0;
        $cienciasMedicasSalud = 0;
        $cienciasAgricolas = 0;
        $cienciasVeterinarias = 0;
        $cienciasSociales = 0;
        $humanidades = 0;

        foreach ($this->educationalInstitutionFaculties as $educationalInstitutionFaculty) {
            foreach ($educationalInstitutionFaculty->researchGroups as $researchGroup) {
                foreach ($researchGroup->researchTeams as $researchTeam) {
                    foreach ($researchTeam->projects as $project) {
                        foreach ($project->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline) {
                            switch ($knowledgeSubareaDiscipline->knowledgeSubarea->knowledgeArea->name) {
                                case 'Industrias creativas':
                                    $industriasCreativas++;
                                    break;
                                case 'Ciencias naturales':
                                    $cienciasNaturales++;
                                    break;
                                case 'Ingeniería y tecnología':
                                    $ingenieriaTecnologia++;
                                    break;
                                case 'Cuarta revolución industrial':
                                    $cuartaRevolucionIndustrial++;
                                    break;
                                case 'Ciencias médicas y de salud':
                                    $cienciasMedicasSalud++;
                                    break;
                                case 'Ciencias agrícolas':
                                    $cienciasAgricolas++;
                                    break;
                                case 'Ciencias veterinarias':
                                    $cienciasVeterinarias++;
                                    break;
                                case 'Ciencias sociales':
                                    $cienciasSociales++;
                                    break;
                                case 'Humanidades':
                                    $humanidades++;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                }
            }
        }

        return $projectsByKnowledgeArea = collect([
            'industriasCreativas' => $industriasCreativas,
            'cienciasNaturales' => $cienciasNaturales,
            'ingenieriaTecnologia' => $ingenieriaTecnologia,
            'cuartaRevolucionIndustrial' => $cuartaRevolucionIndustrial,
            'cienciasMedicasSalud' => $cienciasMedicasSalud,
            'cienciasAgricolas' => $cienciasAgricolas,
            'cienciasVeterinarias' => $cienciasVeterinarias,
            'cienciasSociales' => $cienciasSociales,
            'humanidades' => $humanidades,
        ]);
    }

    public function projectsByProjectTypes() {
        $investigacionAplicada  = 0;
        $investigacionBasica    = 0;
        $desarrolloTecnologico  = 0;

        foreach ($this->educationalInstitutionFaculties as $educationalInstitutionFaculty) {
            foreach ($educationalInstitutionFaculty->researchGroups as $researchGroup) {
                foreach ($researchGroup->researchTeams as $researchTeam) {
                    foreach ($researchTeam->projects as $project) {
                        switch ($project->projectType->type) {
                            case 'investigación aplicada':
                                $investigacionAplicada++;
                                break;
                            case 'investigación básica':
                                $investigacionBasica++;
                                break;
                            case 'desarrollo tecnológico':
                                $desarrolloTecnologico++;
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }

        return $projectsByProjectTypes = collect([
            'investigacionAplicada' => $investigacionAplicada,
            'investigacionBasica'   => $investigacionBasica,
            'desarrolloTecnologico' => $desarrolloTecnologico,
        ]);
    }

    public function projectsByYear() {
        return DB::table('projects')->select(DB::raw("date_part('year', projects.end_date), COUNT(date_part('year', projects.end_date))"))->join("project_research_team", "projects.id", "project_research_team.project_id")->join("research_teams", "project_research_team.research_team_id", "research_teams.id")->join("research_groups", "research_teams.research_group_id", "research_groups.id")->join("educational_institution_faculties", "research_groups.educational_institution_faculty_id", "educational_institution_faculties.id")->join("educational_institutions", "educational_institution_faculties.educational_institution_id", "educational_institutions.id")->where("educational_institutions.id", $this->id)->groupBy(DB::raw("date_part('year', projects.end_date)"))->get();
    }

    public function qtyGraduationsInfo() {
        return DB::table('graduations')->select(DB::raw('count(DISTINCT educational_institution_faculty_members.user_id)'))->join('educational_institution_faculty_members', 'graduations.user_id', 'educational_institution_faculty_members.user_id')->join("educational_institution_faculties", "educational_institution_faculty_members.educational_institution_faculty_id", "educational_institution_faculties.id")->join("educational_institutions", "educational_institution_faculties.educational_institution_id", "educational_institutions.id")->where('educational_institutions.id', $this->id)->count();
    }

    public function qtyResearchTeams() {
        return DB::table('research_teams')
            ->join('research_groups', 'research_teams.research_group_id', 'research_groups.id')
            ->join('educational_institution_faculties', 'research_groups.educational_institution_faculty_id','educational_institution_faculties.id')->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyResearchGroups() {
        return DB::table('research_groups')
            ->join('educational_institution_faculties', 'research_groups.educational_institution_faculty_id','educational_institution_faculties.id')->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyEducationalEnvironments() {
        return DB::table('educational_environments')
            ->join('educational_institution_faculties', 'educational_environments.educational_institution_faculty_id','educational_institution_faculties.id')->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyProjects() {
        return DB::table('projects')
            ->join('project_research_team', 'projects.id', 'project_research_team.project_id')
            ->join('research_teams', 'project_research_team.research_team_id', 'research_teams.id')
            ->join('research_groups', 'research_teams.research_group_id', 'research_groups.id')
            ->join('educational_institution_faculties', 'research_groups.educational_institution_faculty_id','educational_institution_faculties.id')->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyResearchOutputs() {
        return DB::table('research_outputs')
            ->join('projects', 'research_outputs.project_id', 'projects.id')
            ->join('project_research_team', 'projects.id', 'project_research_team.project_id')
            ->join('research_teams', 'project_research_team.research_team_id', 'research_teams.id')
            ->join('research_groups', 'research_teams.research_group_id', 'research_groups.id')
            ->join('educational_institution_faculties', 'research_groups.educational_institution_faculty_id','educational_institution_faculties.id')->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyAcademicPrograms() {
        return DB::table('academic_programs')->join('educational_institution_faculties', 'academic_programs.educational_institution_faculty_id','educational_institution_faculties.id')->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyUsers() {
        return DB::table('users')
            ->join('educational_institution_faculty_members', 'users.id', 'educational_institution_faculty_members.user_id')
            ->join('educational_institution_faculties', 'educational_institution_faculty_members.educational_institution_faculty_id', 'educational_institution_faculties.id')
            ->where('educational_institution_faculties.educational_institution_id', $this->id)->count();
    }

    public function qtyEvents() {
        return DB::table('educational_institution_events')->where('educational_institution_events.educational_institution_id', $this->id)->count();
    }

    public function eventsAndProjects() {
        return DB::table('educational_institution_events')->select(DB::raw('events.name, count(event_project.event_id)'))->join('events', 'educational_institution_events.id', 'events.id')->join('event_project', 'events.id', 'event_project.event_id')->where('educational_institution_events.educational_institution_id', $this->id)->groupBy('event_project.event_id', 'events.name')->get();
    }
}
