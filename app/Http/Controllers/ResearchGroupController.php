<?php

namespace App\Http\Controllers;

use App\ResearchGroup;
use Illuminate\Http\Request;
use App\Researcher;

class ResearchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researchGroups = ResearchGroup::orderBy('name')->paginate(50);
        return view('ResearchGroups.index', compact('researchGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ResearchGroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $researchGroup = new ResearchGroup();
        $researchGroup->name                    = $request->get('name');
        $researchGroup->email                   = $request->get('email');
        $researchGroup->leader                  = $request->get('leader');
        $researchGroup->gruplac                 = $request->get('gruplac');
        $researchGroup->minciencias_code        = $request->get('minciencias_code');
        $researchGroup->minciencias_category    = $request->get('minciencias_category');
        $researchGroup->website                 = $request->get('website');
        $researchGroup->educationalInstitution()->associate($request->get('educational_institution_id'));
        
        if($researchGroup->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('research-groups.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchGroup $researchGroup)
    {
        return view('ResearchGroups.show', compact('researchGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchGroup $researchGroup)
    {
        return view('ResearchGroups.edit', compact('researchGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchGroup $researchGroup)
    {
        $researchGroup->name                    = $request->get('name');
        $researchGroup->email                   = $request->get('email');
        $researchGroup->leader                  = $request->get('leader');
        $researchGroup->gruplac                 = $request->get('gruplac');
        $researchGroup->minciencias_code        = $request->get('minciencias_code');
        $researchGroup->minciencias_category    = $request->get('minciencias_category');
        $researchGroup->website                 = $request->get('website');
        $researchGroup->educationalInstitution()->associate($request->get('educational_institution_id'));
        
        if($researchGroup->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('research-groups.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchGroup $researchGroup)
    {
        if($researchGroup->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('research-groups.index')->with('status', $message);
    }

    /**
     * Get research teams by research group.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function getResearchTeams(ResearchGroup $researchGroup)
    {
        return $researchGroup->researchTeams()->get();
    }
}
