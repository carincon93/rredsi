<?php

namespace App\Http\Controllers;

use App\Project;
use App\Event;
use Illuminate\Http\Request;
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
        $projects = Project::orderBy('name')->paginate(50);
        return view('Projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        if($project->save()){
            $message = 'Your store processed correctly';
        }

        $project->researchTeams()->attach($request->get('research_team_id'), ['is_principal' => false]);
        $project->researchLines()->attach($request->get('research_line_id'));
        $project->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $project->academicPrograms()->attach($request->get('academic_program_id'));
        $project->authors()->attach($request->get('user_id'));

        return redirect()->route('projects.index')->with('status', $message);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('Projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('Projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
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

        if($project->save()){
            $message = 'Your update processed correctly';
        }

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

        return redirect()->route('projects.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('projects.index')->with('status', $message);
    }

    /**
     * Register for an event
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function registerEvent(Project $project, Request $request)
    {
        return view('Projects.registerEvent', compact('project'));
    }
}
