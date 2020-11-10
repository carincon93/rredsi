<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ResearchOutputRequest;
use App\ResearchOutput;

class ResearchOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResearchOutput::with('project')->get();
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
    public function store(ResearchOutputRequest $request)
    {
        $researchOutput = new ResearchOutput();
        $researchOutput->title          = $request->get('title');
        $researchOutput->typology       = $request->get('typology');
        $researchOutput->description    = $request->get('description');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            Storage::putFileAs(
                'public/research-outputs', $file, $fileName
            );

            $researchOutput->file  = "research-outputs/$fileName";
        }
        $researchOutput->project()->associate($request->get('project_id'));
        $researchOutput->save();

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
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchOutput $researchOutput)
    {
        return response()->json($researchOutput);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchOutput $researchOutput)
    {
        return response()->json($researchOutput);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchOutputRequest $request, ResearchOutput $researchOutput)
    {
        $researchOutput->title          = $request->get('title');
        $researchOutput->typology       = $request->get('typology');
        $researchOutput->description    = $request->get('description');
        if ($request->hasFile('file')) {
            $path  = Storage::putFile(
                'public/research-outputs', $request->file('file')
            );

            $researchOutput->file = $path;
        }
        $researchOutput->project()->associate($request->get('project_id'));
        $researchOutput->save();

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
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchOutput $researchOutput)
    {
        try
        {
            if($researchOutput->delete()){
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
