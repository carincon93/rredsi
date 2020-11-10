<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResearchLineRequest;
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
        return ResearchLine::with('researchGroup')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchLineRequest $request)
    {
        $researchLine = new ResearchLine();
        $researchLine->name         = $request->get('name');
        $researchLine->objectives   = $request->get('objectives');
        $researchLine->mission      = $request->get('mission');
        $researchLine->vision       = $request->get('vision');
        $researchLine->achievements = $request->get('achievements');
        $researchLine->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $researchLine->researchGroup()->associate($request->get('research_group_id'));
        $researchLine->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your store processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchLine $researchLine)
    {
        return response()->json($researchLine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchLine $researchLine)
    {
        return response()->json($researchLine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchLineRequest $request, ResearchLine $researchLine)
    {
        $researchLine->name         = $request->get('name');
        $researchLine->objectives   = $request->get('objectives');
        $researchLine->mission      = $request->get('mission');
        $researchLine->vision       = $request->get('vision');
        $researchLine->achievements = $request->get('achievements');
        $researchLine->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $researchLine->researchGroup()->associate($request->get('research_group_id'));
        $researchLine->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your update processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchLine  $researchLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchLine $researchLine)
    {
        try
        {
            if($researchLine->delete()){
                return 'Eliminado';
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return 'Error 23000';
            }
        }
    }
}
