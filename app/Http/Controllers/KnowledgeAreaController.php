<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnowledgeAreaRequest;
use App\Models\KnowledgeArea;
use Illuminate\Http\Request;

class KnowledgeAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();
        
        return view('KnowledgeAreas.index', compact('knowledgeAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('KnowledgeAreas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeAreaRequest $request)
    {
        $knowledgeArea          = new KnowledgeArea();
        $knowledgeArea->name    = $request->get('name');

        if($knowledgeArea->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('knowledge-areas.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeArea $knowledgeArea)
    {
        return view('KnowledgeAreas.show', compact('knowledgeArea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeArea $knowledgeArea)
    {
        return view('KnowledgeAreas.edit', compact('knowledgeArea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeAreaRequest $request, KnowledgeArea $knowledgeArea)
    {
        $knowledgeArea->name = $request->get('name');

        if($knowledgeArea->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('knowledge-areas.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeArea $knowledgeArea)
    {
        if($knowledgeArea->delete()){
            $message = 'Your delete processed correctly';
        }
        return redirect()->route('knowledge-areas.index')->with('status', $message);
    }
}
