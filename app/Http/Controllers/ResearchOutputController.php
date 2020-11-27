<?php

namespace App\Http\Controllers;


use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;
use App\Models\ResearchTeam;
use App\Models\ResearchOutput;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ResearchOutputRequest;
use Illuminate\Http\Request;

class ResearchOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        $researchOutputs = $researchTeam->researchOutputs()->orderBy('title')->get();

        return view('ResearchOutputs.index', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'researchOutputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        return view('ResearchOutputs.create', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchOutputRequest $request)
    {
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
        $researchOutput->project()->associate($request->get('project_id'));

        if($researchOutput->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.research-outputs.index', [$node, $educationalInstitution, $researchGroup, $researchTeam])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, ResearchOutput $researchOutput)
    {

        return view('ResearchOutputs.show', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'researchOutput'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, ResearchOutput $researchOutput)
    {
        return view('ResearchOutputs.edit', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'researchOutput'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchOutputRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, ResearchOutput $researchOutput)
    {
        $researchOutput->title          = $request->get('title');
        $researchOutput->typology       = $request->get('typology');
        $researchOutput->description    = $request->get('description');
        if ($request->hasFile('file')) {
            $path  = Storage::putFile(
                'public/research-outputs', $request->file('file')
            );

            $researchOutput->file = $path;
        }
        $researchOutput->project()->associate($request->get('project_id'));

        if($researchOutput->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.research-outputs.index', [$node, $educationalInstitution, $researchGroup, $researchTeam])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam, ResearchOutput $researchOutput)
    {
        if($researchOutput->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.research-outputs.index', [$node, $educationalInstitution, $researchGroup, $researchTeam])->with('status', $message);
    }
}
