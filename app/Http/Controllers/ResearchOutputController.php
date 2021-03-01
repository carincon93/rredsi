<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use App\Models\ResearchGroup;
use App\Models\ResearchTeam;
use App\Models\Project;
use App\Models\ResearchOutput;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;

use App\Http\Requests\ResearchOutputRequest;
use Illuminate\Http\Request;

class ResearchOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $this->authorize('viewAny', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        $researchOutputs = $project->researchOutputs()->orderBy('title')->get();

        return view('ResearchOutputs.index', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project', 'researchOutputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $this->authorize('create', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        $mincienciasTypologies = json_decode(Storage::get('public/json/minciencias_typologies.json'), true);

        return view('ResearchOutputs.create', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project', 'mincienciasTypologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchOutputRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project)
    {
        $this->authorize('create', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        $researchOutput = new ResearchOutput();
        $researchOutput->title          = $request->get('title');
        $researchOutput->typology       = $request->get('typology');
        $researchOutput->description    = $request->get('description');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            Storage::putFileAs(
                'public/research-outputs', $file, $fileName
            );

            $researchOutput->file  = "research-outputs/$fileName";
        }
        $researchOutput->project()->associate($project);

        if($researchOutput->save()){

            // Send notification authors create researchOutput
            $authors = $project->authors;
            $type = "Producto de investigación";
            Notification::send($authors, new InformationNotification($researchOutput,$type));

            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project, ResearchOutput $researchOutput)
    {
        $this->authorize('view', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        return view('ResearchOutputs.show', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project', 'researchOutput'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project, ResearchOutput $researchOutput)
    {
        $this->authorize('update', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        $mincienciasTypologies = json_decode(Storage::get('public/json/minciencias_typologies.json'), true);

        return view('ResearchOutputs.edit', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchTeam', 'project', 'researchOutput', 'mincienciasTypologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchOutputRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project, ResearchOutput $researchOutput)
    {
        $this->authorize('update', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        $researchOutput->title          = $request->get('title');
        $researchOutput->typology       = $request->get('typology');
        $researchOutput->description    = $request->get('description');
        if ($request->hasFile('file')) {
            $path  = Storage::putFile(
                'public/research-outputs', $request->file('file')
            );

            $researchOutput->file = $path;
        }
        $researchOutput->project()->associate($project);

        if($researchOutput->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchTeam $researchTeam, Project $project, ResearchOutput $researchOutput)
    {
        $this->authorize('delete', [ResearchOutput::class ,$educationalInstitution,$researchTeam,$project]);

        if($researchOutput->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project])->with('status', $message);
    }
}
