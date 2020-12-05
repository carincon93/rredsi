<?php
namespace App\Http\Controllers;

use App\Models\ProjectType;
Use App\Models\KnowledgeSubareaDiscipline;
use App\Models\Node;
use App\Models\EducationalInstitution;
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
    public function index(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $projects = $researchTeam->projects()->orderBy('title')->get();

        return view('Projects.index',  compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $projectTypes       = ProjectType::orderBy('type')->get();
        $researchTeams      = $researchGroup->researchTeams()->get();
        $researchLines      = $researchGroup->researchLines()->get();
        $knowledgeSubareaDisciplines     = knowledgeSubareaDiscipline::orderBy('name')->get();
        $academicPrograms   = $educationalInstitution->academicPrograms()->orderBy('name')->get();
        $authors            = $educationalInstitution->members()->orderBy('name')->get();

        return view('Projects.create', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'projectTypes', 'researchTeams', 'researchLines', 'knowledgeSubareaDisciplines', 'academicPrograms', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $project = new Project();
        $project->title             = $request->get('title');
        $project->start_date        = $request->get('start_date');
        $project->end_date          = $request->get('end_date');
        $project->abstract          = $request->get('abstract');
        $project->keywords          = $request->get('keywords');
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

        $project->researchTeams()->attach($request->get('research_team_id'), ['is_principal' => false]);
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_dicipline_id'));
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->attach($request->get('user_id'));

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $researchGroup, $researchTeam])->with('status', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        return view('Projects.show', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $projectTypes       = ProjectType::orderBy('type')->get();
        $researchTeams      = $researchGroup->researchTeams()->get();
        $researchLines      = $researchGroup->researchLines()->get();
        $knowledgeSubareaDisciplines     = KnowledgeSubareaDiscipline::orderBy('name')->get();
        $academicPrograms   = $educationalInstitution->academicPrograms()->orderBy('name')->get();
        $authors            = $educationalInstitution->members()->orderBy('name')->get();

        return view('Projects.edit', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'project', 'projectTypes', 'researchTeams', 'researchLines', 'knowledgeSubareaDisciplines', 'academicPrograms', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $project->title             = $request->get('title');
        $project->start_date        = $request->get('start_date');
        $project->end_date          = $request->get('end_date');
        $project->abstract          = $request->get('abstract');
        $project->keywords          = $request->get('keywords');
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

        $project->researchTeams()->attach($request->get('research_team_id'), ['is_principal' => false]);
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_dicipline_id'));
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->attach($request->get('user_id'));

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $researchGroup, $researchTeam])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        if($project->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $researchGroup, $researchTeam])->with('status', $message);
    }
}
