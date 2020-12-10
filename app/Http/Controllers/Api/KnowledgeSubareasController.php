<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeSubarea;
use App\Models\KnowledgeArea;
use Illuminate\Http\Request;

class KnowledgeSubareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KnowledgeArea $knowledgeArea)
    {
        $KnowledgeSubareas = $knowledgeArea->knowledgeSubareas()->get();
        // $KnowledgeSubareas = KnowledgeSubarea::orderBy('name')

        return response(['KnowledgeSubareas' => $KnowledgeSubareas]);
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
     * @param  \App\Models\KnowledgeSubarea  $KnowledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeSubarea $KnowledgeSubarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnowledgeSubarea  $KnowledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KnowledgeSubarea $KnowledgeSubarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KnowledgeSubarea  $KnowledgeSubarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeSubarea $KnowledgeSubarea)
    {
        //
    }
}
