<?php

namespace App\Http\Controllers;

use App\KnowledgeArea;
use Illuminate\Http\Request;
use App\Http\Requests\KnowledgeAreaRequest;

class KnowledgeAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KnowledgeArea::all();
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
    public function store(KnowledgeAreaRequest $request)
    {
        $knowledgeArea          = new KnowledgeArea();
        $knowledgeArea->name    = $request->get('name');
        $knowledgeArea->save();

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
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeArea $knowledgeArea)
    {
        return response()->json($knowledgeArea);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeArea $knowledgeArea)
    {
        return response()->json($knowledgeArea);
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
        $knowledgeArea->save();

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
     * @param  \App\KnowledgeArea  $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeArea $knowledgeArea)
    {
        try
        {
            $knowledgeArea = KnowledgeArea::find($knowledgeArea);
            if($knowledgeArea->delete()){
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
