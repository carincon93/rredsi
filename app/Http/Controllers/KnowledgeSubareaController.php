<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnowledgeSubareaRequest;
use App\Models\knowledgeSubarea;
use App\Models\KnowledgeArea;

use Illuminate\Http\Request;

class KnowledgeSubareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowledgeSubareas = knowledgeSubarea::orderBy('name')->get();
        return view('KnowledgeSubareas.index', compact('knowledgeSubareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();
        return view('KnowledgeSubareas.create', compact('knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeSubareaRequest $request, KnowledgeSubarea $knowledgeSubareas )
    {

        $knowledgeSubareas          = new KnowledgeSubarea();
        $knowledgeSubareas->name    = $request->get('name');
        $knowledgeSubareas->knowledgeArea()->associate($request->get('knowledge_area_id'));

        if($knowledgeSubareas->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('knowledge-subareas.index')->with('status', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\knwoledge_subareas  $knwoledge_subareas
     * @return \Illuminate\Http\Response
     */
    public function show(knowledgeSubarea $knowledgeSubarea)
    {
        return view('KnowledgeSubareas.show', compact('knowledgeSubarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\knwoledge_subareas  $knwoledge_subareas
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeSubarea $KnowledgeSubarea)
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();
        return view('KnowledgeSubareas.edit', compact('KnowledgeSubarea','knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\knwoledge_subareas  $knwoledge_subareas
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeSubareaRequest $request, KnowledgeSubarea $knowledgeSubareas)
    {

        $knowledgeSubareas->name    = $request->get('name');
        $knowledgeSubareas->KnowledgeArea()->associate($request->get('knowledge_area_id'));

        if($knowledgeSubareas->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('knowledge-subareas.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\knwoledge_subareas  $knwoledge_subareas
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeSubarea $knowledgeSubareas)
    {
        if($knowledgeSubareas->delete()){
            $message = 'Your delete processed correctly';
        }
        return redirect()->route('knowledge-subareas.index')->with('status', $message);
    }
}
