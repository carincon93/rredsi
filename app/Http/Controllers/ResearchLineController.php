<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;
use App\Models\ResearchLine;
use App\Models\KnowledgeArea;

use App\Http\Requests\ResearchLineRequest;
use Illuminate\Http\Request;


class ResearchLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup)
    {
        $researchLines = $researchGroup->researchLines()->orderBy('name')->get();

        return view('ResearchLines.index', compact('node', 'educationalInstitution', 'researchGroup', 'researchLines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup)
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('ResearchLines.create', compact('node', 'educationalInstitution', 'researchGroup', 'knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchLineRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup)
    {
        $researchLine = new ResearchLine();
        $researchLine->name         = $request->get('name');
        $researchLine->objectives   = $request->get('objectives');
        $researchLine->mission      = $request->get('mission');
        $researchLine->vision       = $request->get('vision');
        $researchLine->achievements = $request->get('achievements');
        $researchLine->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $researchLine->researchGroup()->associate($researchGroup);

        if($researchLine->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-lines.index', [$node, $educationalInstitution, $researchGroup])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        return view('ResearchLines.show', compact('node', 'educationalInstitution', 'researchGroup', 'researchLine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('ResearchLines.edit', compact('node', 'educationalInstitution', 'researchGroup', 'researchLine', 'knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchLineRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        $researchLine->name         = $request->get('name');
        $researchLine->objectives   = $request->get('objectives');
        $researchLine->mission      = $request->get('mission');
        $researchLine->vision       = $request->get('vision');
        $researchLine->achievements = $request->get('achievements');
        $researchLine->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $researchLine->researchGroup()->associate($researchGroup);

        if($researchLine->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-lines.index', [$node, $educationalInstitution, $researchGroup])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        if($researchLine->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-lines.index', [$node, $educationalInstitution, $researchGroup])->with('status', $message);
    }
}
