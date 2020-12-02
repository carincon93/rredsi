<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnowledgeSubareaDiciplineRequest;
use App\Models\knowledgeSubareaDiscipline;
use App\Models\knowledgeSubarea;

use Illuminate\Http\Request;

class KnowledgeSubareaDisciplinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowledgeSubareaDisciplines = knowledgeSubareaDiscipline::orderBy('name')->get();
        return view('knowledgeSubareaDisciplines.index', compact('knowledgeSubareaDisciplines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $knowledgeSubareas = knowledgeSubarea::orderBy('name')->get();
        return view('knowledgeSubareaDisciplines.create', compact('knowledgeSubareas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeSubareaDiciplineRequest $request,  KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        $knowledgeSubareaDiscipline          = new KnowledgeSubareaDiscipline();
        $knowledgeSubareaDiscipline->name    = $request->get('name');
        $knowledgeSubareaDiscipline->knowledgeSubarea()->associate($request->get('knowledge_subarea_id'));

        if($knowledgeSubareaDiscipline->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('knowledge-subarea-disciplines.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\knowledge_subarea_disciplines  $knowledge_subarea_disciplines
     * @return \Illuminate\Http\Response
     */
    public function show(knowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        return view('knowledgeSubareaDisciplines.show', compact('knowledgeSubareaDiscipline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\knowledge_subarea_disciplines  $knowledge_subarea_disciplines
     * @return \Illuminate\Http\Response
     */
    public function edit(knowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        $knowledgeSubareas = KnowledgeSubarea::orderBy('name')->get();
        return view('knowledgeSubareaDisciplines.edit', compact('knowledgeSubareaDiscipline','knowledgeSubareas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\knowledge_subarea_disciplines  $knowledge_subarea_disciplines
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeSubareaDiciplineRequest $request, knowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        $knowledgeSubareaDiscipline->name    = $request->get('name');
        $knowledgeSubareaDiscipline->knowledgeSubarea()->associate($request->get('knowledge_subarea_id'));

        if($knowledgeSubareaDiscipline->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('knowledge-subarea-disciplines.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\knowledge_subarea_disciplines  $knowledge_subarea_disciplines
     * @return \Illuminate\Http\Response
     */
    public function destroy(knowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        if($knowledgeSubareaDiscipline->delete()){
            $message = 'Your delete processed correctly';
        }
        return redirect()->route('knowledge-subarea-disciplines.index')->with('status', $message);
    }
}
