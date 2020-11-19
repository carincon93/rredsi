<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Researcher;
use App\ResearchGroup;
use App\ResearchLine;

class ResearchLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researchLines = ResearchGroup::orderBy('name')->paginate(50);
        return view('ResearchLines.index', compact('researchLines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ResearchLines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $researchLine = new ResearchLine();
        $researchLine->name         = $request->get('name');
        $researchLine->objectives   = $request->get('objectives');
        $researchLine->mission      = $request->get('mission');
        $researchLine->vision       = $request->get('vision');
        $researchLine->achievements = $request->get('achievements');
        $researchLine->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $researchLine->researchGroup()->associate($request->get('research_group_id'));
        
        if($researchLine->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('research-lines.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchLine $researchLine)
    {
        return view('ResearchLines.show', compact('researchLine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchLine $researchLine)
    {
        return view('ResearchLines.edit', compact('researchLine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchLine $researchLine)
    {
        $researchLine->name         = $request->get('name');
        $researchLine->objectives   = $request->get('objectives');
        $researchLine->mission      = $request->get('mission');
        $researchLine->vision       = $request->get('vision');
        $researchLine->achievements = $request->get('achievements');
        $researchLine->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $researchLine->researchGroup()->associate($request->get('research_group_id'));
        
        if($researchLine->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('research-lines.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchLine $researchLine)
    {
        if($researchLine->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('research-lines.index')->with('status', $message);
    }
}
