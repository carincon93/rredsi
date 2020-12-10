<?php
namespace App\Http\Controllers;

use App\Models\ProjectType;
Use App\Models\KnowledgeSubareaDiscipline;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use App\Models\ResearchGroup;
use App\Models\ResearchTeam;
use App\Models\Project;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $projects = $researchTeam->projects()->orderBy('title')->get();

        return view('Projects.index',  compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $projectTypes                               = ProjectType::orderBy('type')->get();
        $knowledgeSubareaDisciplines                = KnowledgeSubareaDiscipline::orderBy('name')->get();
        $educationalInstitutionFacultyResearchTeams = $researchGroup->researchTeams()->get();
        $researchTeams                              = ResearchTeam::orderBy('name')->get();
        $researchLines                              = $researchGroup->researchLines()->get();
        $academicPrograms                           = $faculty->academicPrograms()->orderBy('name')->get();
        $authors                                    = $faculty->members()->orderBy('name')->get();

        return view('Projects.create', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'projectTypes', 'researchTeams', 'researchLines', 'knowledgeSubareaDisciplines', 'academicPrograms', 'authors', 'educationalInstitutionFacultyResearchTeams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $project = new Project();
        $project->title                             = $request->get('title');
        $project->start_date                        = $request->get('start_date');
        $project->end_date                          = $request->get('end_date');
        $project->abstract                          = $request->get('abstract');
        $project->keywords                          = $request->get('keywords');
        $project->roles_requirements_description    = $request->get('roles_requirements_description');
        $project->tools_requirements_description    = $request->get('tools_requirements_description');
        $project->roles_requirements                = $request->get('roles_requirements');
        $project->tools_requirements                = $request->get('tools_requirements');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            Storage::putFileAs(
                'public/projects', $file, $fileName
            );

            $project->file  = "projects/$fileName";
        }
        $project->overall_objective = $request->get('overall_objective');
        $project->is_privated       = $request->get('is_privated');
        $project->is_published      = $request->get('is_published');
        $project->projectType()->associate($request->get('project_type_id'));

        if($project->save()){
            $message = 'Your store processed correctly';
        }

        $arrayResearchTeamsIds = $request->get('research_team_id');
        if (($key = array_search($request->get('principal_research_team_id'), $arrayResearchTeamsIds)) !== false) {
            unset($arrayResearchTeamsIds[$key]);
        }

        $project->researchTeams()->attach($request->get('principal_research_team_id'), ['is_principal' => true]);
        $project->researchTeams()->attach($arrayResearchTeamsIds, ['is_principal' => false]);
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_dicipline_id'));
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->attach($request->get('user_id'));

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam])->with('status', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        return view('Projects.show', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $projectTypes                               = ProjectType::orderBy('type')->get();
        $knowledgeSubareaDisciplines                = KnowledgeSubareaDiscipline::orderBy('name')->get();
        $educationalInstitutionFacultyResearchTeams = $researchGroup->researchTeams()->get();
        $researchTeams                              = ResearchTeam::orderBy('name')->get();
        $researchLines                              = $researchGroup->researchLines()->get();
        $academicPrograms                           = $faculty->academicPrograms()->orderBy('name')->get();
        $authors                                    = $faculty->members()->orderBy('name')->get();

        return view('Projects.edit', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project', 'projectTypes', 'researchTeams', 'researchLines', 'knowledgeSubareaDisciplines', 'academicPrograms', 'authors', 'educationalInstitutionFacultyResearchTeams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $project->title                             = $request->get('title');
        $project->start_date                        = $request->get('start_date');
        $project->end_date                          = $request->get('end_date');
        $project->abstract                          = $request->get('abstract');
        $project->keywords                          = $request->get('keywords');
        $project->roles_requirements_description    = $request->get('roles_requirements_description');
        $project->tools_requirements_description    = $request->get('tools_requirements_description');
        $project->roles_requirements                = $request->get('roles_requirements');
        $project->tools_requirements                = $request->get('tools_requirements');
        if ($request->hasFile('file')) {
            $path  = Storage::putFile(
                'public/projects', $request->file('file')
            );

            $project->file = $path;
        }
        $project->overall_objective = $request->get('overall_objective');
        $project->is_privated       = $request->get('is_privated');
        $project->is_published      = $request->get('is_published');
        $project->projectType()->associate($request->get('project_type_id'));

        if($project->save()){
            $message = 'Your update processed correctly';
        }

        $arrayResearchTeamsIds = $request->get('research_team_id');
        if (($key = array_search($request->get('principal_research_team_id'), $arrayResearchTeamsIds)) !== false) {
            unset($arrayResearchTeamsIds[$key]);
        }

        $project->researchTeams()->attach($request->get('principal_research_team_id'), ['is_principal' => true]);
        $project->researchTeams()->attach($arrayResearchTeamsIds, ['is_principal' => false]);
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_dicipline_id'));
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->attach($request->get('user_id'));

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        if($project->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam])->with('status', $message);
    }
}
