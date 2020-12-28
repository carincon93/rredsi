<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use App\Models\ResearchGroup;

use App\Http\Requests\ResearchGroupRequest;
use Illuminate\Http\Request;

class ResearchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('viewAny', ResearchGroup::class , $node, $educationalInstitution , $faculty);

        $researchGroups = $faculty->researchGroups()->orderBy('name')->get();

        return view('ResearchGroups.index', compact('node', 'educationalInstitution', 'faculty', 'researchGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('create', ResearchGroup::class , $node, $educationalInstitution , $faculty);

        return view('ResearchGroups.create', compact('node', 'educationalInstitution', 'faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchGroupRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('create', ResearchGroup::class , $node, $educationalInstitution , $faculty);

        $researchGroup = new ResearchGroup();
        $researchGroup->name                    = $request->get('name');
        $researchGroup->email                   = $request->get('email');
        $researchGroup->leader                  = $request->get('leader');
        $researchGroup->gruplac                 = $request->get('gruplac');
        $researchGroup->minciencias_code        = $request->get('minciencias_code');
        $researchGroup->minciencias_category    = $request->get('minciencias_category');
        $researchGroup->website                 = $request->get('website');
        $researchGroup->educationalInstitutionFaculty()->associate($faculty);

        if($researchGroup->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('view', ResearchGroup::class , $node, $educationalInstitution , $faculty, $researchGroup);

        return view('ResearchGroups.show', compact('node', 'educationalInstitution', 'faculty', 'researchGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('update', ResearchGroup::class , $node, $educationalInstitution , $faculty, $researchGroup);

        return view('ResearchGroups.edit', compact('node', 'educationalInstitution', 'faculty', 'researchGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchGroupRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('update', ResearchGroup::class , $node, $educationalInstitution , $faculty, $researchGroup);

        $researchGroup->name                    = $request->get('name');
        $researchGroup->email                   = $request->get('email');
        $researchGroup->leader                  = $request->get('leader');
        $researchGroup->gruplac                 = $request->get('gruplac');
        $researchGroup->minciencias_code        = $request->get('minciencias_code');
        $researchGroup->minciencias_category    = $request->get('minciencias_category');
        $researchGroup->website                 = $request->get('website');
        $researchGroup->educationalInstitutionFaculty()->associate($faculty);

        if($researchGroup->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, ResearchGroup $researchGroup)
    {
        $this->authorize('delete', ResearchGroup::class , $node, $educationalInstitution , $faculty, $researchGroup);

        if($researchGroup->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }
}
