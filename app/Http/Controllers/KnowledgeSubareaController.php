<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;
use App\Models\KnowledgeSubarea;

use App\Http\Requests\KnowledgeSubareaRequest;
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
        $this->authorize('viewAny', KnowledgeSubarea::class);

        $knowledgeSubareas = KnowledgeSubarea::orderBy('name')->get();

        return view('KnowledgeSubareas.index', compact('knowledgeSubareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', KnowledgeSubarea::class);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('KnowledgeSubareas.create', compact('knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeSubareaRequest $request)
    {
        $this->authorize('create', KnowledgeSubarea::class);

        $knowledgeSubarea          = new KnowledgeSubarea();
        $knowledgeSubarea->name    = $request->get('name');
        $knowledgeSubarea->knowledgeArea()->associate($request->get('knowledge_area_id'));

        if($knowledgeSubarea->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('knowledge-subareas.index')->with('status', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KnwoledgeSubarea  $knwoledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeSubarea $knowledgeSubarea)
    {
        $this->authorize('view', [KnowledgeSubarea::class , $knowledgeSubarea]);

        return view('KnowledgeSubareas.show', compact('knowledgeSubarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KnwoledgeSubarea  $knwoledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeSubarea $knowledgeSubarea)
    {
        $this->authorize('update', [KnowledgeSubarea::class , $knowledgeSubarea]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('KnowledgeSubareas.edit', compact('knowledgeSubarea','knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnwoledgeSubarea  $knwoledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeSubareaRequest $request, KnowledgeSubarea $knowledgeSubarea)
    {
        $this->authorize('update', KnowledgeSubarea::class , $knowledgeSubarea);

        $knowledgeSubarea->name = $request->get('name');
        $knowledgeSubarea->KnowledgeArea()->associate($request->get('knowledge_area_id'));

        if($knowledgeSubarea->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('knowledge-subareas.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KnwoledgeSubarea  $knwoledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeSubarea $knowledgeSubarea)
    {
        $this->authorize('delete', KnowledgeSubarea::class , $knowledgeSubarea);

        if($knowledgeSubarea->delete()){
            $message = 'Your delete processed correctly';
        }
        return redirect()->route('knowledge-subareas.index')->with('status', $message);
    }
}
