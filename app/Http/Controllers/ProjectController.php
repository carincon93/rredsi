<?php

namespace App\Http\Controllers;

use App\Project;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::with('authors', 'researchTeams')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project();
        $project->title             = $request->get('title');
        $project->start_date        = $request->get('start_date');
        $project->end_date          = $request->get('end_date');
        $project->type              = $request->get('type');
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
        $project->save();

        $project->researchTeams()->attach($request->get('research_team_id'), ['is_principal' => false]);
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->attach($request->get('user_id'));

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your store processed correctly'
        ];

        return response()->json($data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->title             = $request->get('title');
        $project->start_date        = $request->get('start_date');
        $project->end_date          = $request->get('end_date');
        $project->type              = $request->get('type');
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
        $project->save();

        $project->researchTeams()->wherePivot('project_id', '=', $project->id)->detach();
        $project->researchTeams()->attach($request->get('research_team_id'), ['is_principal' => false]);
        $project->researchLines()->wherePivot('project_id', '=', $project->id)->detach();
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeAreas()->wherePivot('project_id', '=', $project->id)->detach();
        $project->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $project->academicPrograms()->wherePivot('project_id', '=', $project->id)->detach();
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->wherePivot('project_id', '=', $project->id)->detach();
        $project->authors()->attach($request->get('user_id'));

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your update processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try
        {
            if($project->delete()){
                return 'Eliminado';
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return 'Error 23000';
            }
        }
    }

    /**
     * Register for an event
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function registerEvent(Project $project, Request $request)
    {
        $project->events()->attach($request->get('event_id'));
    }


}
