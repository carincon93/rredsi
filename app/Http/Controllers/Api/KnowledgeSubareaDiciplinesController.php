<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeArea;
use App\Models\KnowledgeSubarea;
use App\Models\KnowledgeSubareaDiscipline;
use Illuminate\Http\Request;

class KnowledgeSubareaDiciplinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KnowledgeArea $knowledgeArea, KnowledgeSubarea $knowledgeSubarea)
    {
        $KnowledgeSubareaDiscipline = $knowledgeSubarea->knowledgeSubareaDisciplines()->get();

        return response(['KnowledgeSubareaDiscipline' => $KnowledgeSubareaDiscipline]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $KnowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeSubareaDiscipline $KnowledgeSubareaDiscipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnowledgeSubareaDiscipline  $KnowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KnowledgeSubareaDiscipline $KnowledgeSubareaDiscipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $KnowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeSubareaDiscipline $KnowledgeSubareaDiscipline)
    {
        //
    }
}
