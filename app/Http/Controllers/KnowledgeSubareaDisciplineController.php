<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeSubarea;
use App\Models\KnowledgeSubareaDiscipline;

use App\Http\Requests\KnowledgeSubareaDisciplineRequest;
use Exception;
use Illuminate\Http\Request;

class KnowledgeSubareaDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', [KnowledgeSubareaDiscipline::class]);

        $knowledgeSubareaDisciplines = KnowledgeSubareaDiscipline::orderBy('name')->get();

        return view('KnowledgeSubareaDisciplines.index', compact('knowledgeSubareaDisciplines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [KnowledgeSubareaDiscipline::class]);

        $knowledgeSubareas = KnowledgeSubarea::orderBy('name')->get();

        return view('KnowledgeSubareaDisciplines.create', compact('knowledgeSubareas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeSubareaDisciplineRequest $request)
    {
        $this->authorize('create', [KnowledgeSubareaDiscipline::class]);

        $knowledgeSubareaDiscipline          = new KnowledgeSubareaDiscipline();
        $knowledgeSubareaDiscipline->name    = $request->get('name');
         // ? asociamos la disciplina al sub area
        $knowledgeSubareaDiscipline->knowledgeSubarea()->associate($request->get('knowledge_subarea_id'));

        if($knowledgeSubareaDiscipline->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('knowledge-subarea-disciplines.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        $this->authorize('view', [KnowledgeSubareaDiscipline::class]);

        return view('KnowledgeSubareaDisciplines.show', compact('knowledgeSubareaDiscipline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        $this->authorize('update', [KnowledgeSubareaDiscipline::class]);

        $knowledgeSubareas = KnowledgeSubarea::orderBy('name')->get();

        return view('KnowledgeSubareaDisciplines.edit', compact('knowledgeSubareaDiscipline','knowledgeSubareas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeSubareaDisciplineRequest $request, KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        $this->authorize('update', [KnowledgeSubareaDiscipline::class]);

        $knowledgeSubareaDiscipline->name = $request->get('name');
         // ? asociamos la disciplina al sub area
        $knowledgeSubareaDiscipline->knowledgeSubarea()->associate($request->get('knowledge_subarea_id'));

        if($knowledgeSubareaDiscipline->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('knowledge-subarea-disciplines.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {

        try {

            $this->authorize('delete', [KnowledgeSubareaDiscipline::class]);

            if($knowledgeSubareaDiscipline->delete()){
                $message = 'Your delete processed correctly';
            }

            return redirect()->route('knowledge-subarea-disciplines.index')->with('status', $message);

        } catch (Exception $e) {
            return [
                'error'=>$e->getMessage()
            ];
        }

    }
}
