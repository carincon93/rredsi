<?php
namespace App\Http\Controllers;

use App\Models\ProjectType;
Use App\Models\KnowledgeArea;
Use App\Models\KnowledgeSubarea;
use App\Models\Node;
use App\Models\User;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use App\Models\ResearchGroup;
use App\Models\ResearchTeam;
use App\Models\Project;


use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $this->authorize('viewAny', [Project::class , $educationalInstitution , $researchTeam]);

        $projects = $researchTeam->projects()->orderBy('title')->get();

        return view('Projects.index',  compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'projects'));
    }


    public function myProjects(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam,Project $project)
    {
        // $this->authorize('view', [Project::class , $educationalInstitution , $researchTeam, $project]);

        $projects = auth()->user()->projects;


        return view('Projects.index',  compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'projects'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $this->authorize('create',[Project::class , $educationalInstitution , $researchTeam]);

        $projectTypes                               = ProjectType::orderBy('type')->get();
        $knowledgeAreas                             = KnowledgeArea::orderBy('name')->get();
        $educationalInstitutionFacultyResearchTeams = $researchGroup->researchTeams()->get();
        $researchTeams                              = ResearchTeam::orderBy('name')->get();
        $researchLines                              = $researchGroup->researchLines()->get();
        $academicPrograms                           = $faculty->academicPrograms()->orderBy('name')->get();
        $authors                                    = $faculty->members()->orderBy('name')->get();

        return view('Projects.create', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'projectTypes', 'researchTeams', 'researchLines', 'knowledgeAreas', 'academicPrograms', 'authors', 'educationalInstitutionFacultyResearchTeams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $this->authorize('create',[Project::class , $educationalInstitution , $researchTeam]);

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
        $project->overall_objective                 = $request->get('overall_objective');
        $project->is_privated                       = $request->get('is_privated');
        $project->is_published                      = $request->get('is_published');
        $project->projectType()->associate($request->get('project_type_id'));

        $end_date = date('Y', strtotime($request->end_date));

        if ($request->hasFile('main_image')) {
            $file       = $request->file('main_image');
            $extension  = $file->extension();
            $fileName   = "$project->id-RREDSI-$end_date-main-image.$extension";
            Storage::putFileAs(
                'public/project-main-images', $file, $fileName
            );

            $project->main_image  = "project-main-images/$fileName";
        }

        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $extension  = $file->extension();
            $fileName   = "$project->id-RREDSI-$end_date-file.$extension";
            Storage::putFileAs(
                'public/projects', $file, $fileName
            );

            $project->file  = "projects/$fileName";
        }

        if($project->save()){
            // if ($request->has('research_team_id')) {
            //     $arrayResearchTeamsIds = $request->get('research_team_id');
            //     if (($key = array_search($request->get('principal_research_team_id'), $arrayResearchTeamsIds)) !== false) {
            //         unset($arrayResearchTeamsIds[$key]);
            //     }
            // }

            $project->researchTeams()->attach($request->get('principal_research_team_id'), ['is_principal' => true]);
            // $project->researchTeams()->attach($arrayResearchTeamsIds, ['is_principal' => false]);
            $project->researchLines()->attach($request->get('research_line_id'));
            $project->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_dicipline_id'));
            $project->academicPrograms()->attach($request->get('academic_program_id'));
            $project->authors()->attach($request->get('user_id'));

            // Send notification student create researchTeam
            $user = auth()->user();
            $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();
            $educationalInstitution = $faculty->educationalInstitution;
            $adminInstitution = $educationalInstitution->administrator;

            $type = "Proyecto";
            Notification::send($adminInstitution, new InformationNotification($project,$type));

            $message = 'Your store processed correctly';
        }



        if(Auth()->user()->hasRole('Estudiante')){
            return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects',[$node,$educationalInstitution,$faculty,$researchGroup,$researchTeam])->with('status', $message);
        }

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
        $this->authorize('view', [Project::class , $educationalInstitution , $researchTeam, $project]);

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
        $this->authorize('update', [Project::class , $educationalInstitution , $researchTeam, $project]);

        $projectTypes                               = ProjectType::orderBy('type')->get();
        $knowledgeAreas                             = KnowledgeArea::orderBy('name')->get();
        $educationalInstitutionFacultyResearchTeams = $researchGroup->researchTeams()->get();
        $researchTeams                              = ResearchTeam::orderBy('name')->get();
        $researchLines                              = $researchGroup->researchLines()->get();
        $academicPrograms                           = $faculty->academicPrograms()->orderBy('name')->get();
        $authors                                    = $faculty->members()->orderBy('name')->get();

        return view('Projects.edit', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project', 'projectTypes', 'researchTeams', 'researchLines', 'knowledgeAreas', 'academicPrograms', 'authors', 'educationalInstitutionFacultyResearchTeams'));
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
        $this->authorize('update', [Project::class , $educationalInstitution , $researchTeam, $project]);

        $project->title                             = $request->get('title');
        $project->start_date                        = $request->get('start_date');
        $project->end_date                          = $request->get('end_date');
        $project->abstract                          = $request->get('abstract');
        $project->keywords                          = $request->get('keywords');
        $project->roles_requirements_description    = $request->get('roles_requirements_description');
        $project->tools_requirements_description    = $request->get('tools_requirements_description');
        $project->roles_requirements                = $request->get('roles_requirements');
        $project->tools_requirements                = $request->get('tools_requirements');
        $project->overall_objective                 = $request->get('overall_objective');
        $project->is_privated                       = $request->get('is_privated');
        $project->is_published                      = $request->get('is_published');
        $project->projectType()->associate($request->get('project_type_id'));

        $end_date = date('Y', strtotime($project->end_date));

        if ($request->hasFile('main_image')) {
            Storage::delete("public/$project->main_image");
            $file       = $request->file('main_image');
            $extension  = $file->extension();
            $fileName   = "$project->id-RREDSI-$end_date-main-image.$extension";
            Storage::putFileAs(
                'public/project-main-images', $file, $fileName
            );

            $project->main_image  = "project-main-images/$fileName";
        }

        if ($request->hasFile('file')) {
            Storage::delete("public/$project->file");
            $file       = $request->file('file');
            $extension  = $file->extension();
            $fileName   = "$project->id-RREDSI-$end_date-file.$extension";
            Storage::putFileAs(
                'public/projects', $file, $fileName
            );

            $project->file  = "projects/$fileName";
        }

        if($project->save()){
            // if ($request->has('research_team_id')) {
            //     $arrayResearchTeamsIds = $request->get('research_team_id');
            //     $request->get('principal_research_team_id');
            //     if (($key = array_search($request->get('principal_research_team_id'), $arrayResearchTeamsIds)) !== false) {
            //         unset($arrayResearchTeamsIds[$key]);
            //     }
            // }

            $project->researchTeams()->sync($request->get('principal_research_team_id'), ['is_principal' => true]);
            // $project->researchTeams()->sync($arrayResearchTeamsIds, ['is_principal' => false]);
            $project->researchLines()->sync($request->get('research_line_id'));
            $project->knowledgeSubareaDisciplines()->sync($request->get('knowledge_subarea_dicipline_id'));
            $project->academicPrograms()->sync($request->get('academic_program_id'));
            $project->authors()->sync($request->get('user_id'));
            $message = 'Your update processed correctly';
        }

        $user = Auth::user();

        if($user->hasRole(4)){
            return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects',[$node,$educationalInstitution,$faculty,$researchGroup,$researchTeam])->with('status', $message);
        }

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
        $this->authorize('delete', [Project::class , $educationalInstitution , $researchTeam, $project]);

        if(!is_null($project->projectType)){
            $message ="No es posible eliminar el proyecto ya que está unido a un tipo de proyecto.";
            return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
        }

        if($project->delete()){
            $message = 'Your delete processed correctly';
        }

        $user = Auth::user();

        if($user->hasRole(4)){
            return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects',[$node,$educationalInstitution,$faculty,$researchGroup,$researchTeam])->with('status', $message);
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam])->with('status', $message);
    }
}
