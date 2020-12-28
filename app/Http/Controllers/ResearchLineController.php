<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
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
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('viewAny', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup);

        $researchLines = $researchGroup->researchLines()->orderBy('name')->get();

        return view('ResearchLines.index', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchLines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('create', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('ResearchLines.create', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchLineRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('create', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup);

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

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-lines.index', [$node, $educationalInstitution, $faculty, $researchGroup])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        $this->authorize('view', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup, $researchLine);

        return view('ResearchLines.show', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchLine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        $this->authorize('update', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup,$researchLine);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('ResearchLines.edit', compact('node', 'educationalInstitution', 'faculty', 'researchGroup', 'researchLine', 'knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchLineRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        $this->authorize('update', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup,$researchLine);

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

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-lines.index', [$node, $educationalInstitution, $faculty, $researchGroup])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup, ResearchLine $researchLine)
    {
        $this->authorize('delete', ResearchLine::class , $node, $educationalInstitution , $faculty, $researchGroup,$researchLine);

        if($researchLine->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-lines.index', [$node, $educationalInstitution, $faculty, $researchGroup])->with('status', $message);
    }
}
