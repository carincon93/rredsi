<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $researchOutputs = ResearchOutput::orderBy('title')->paginate(50);
        return view('ResearchOutputs.index', compact('researchOutputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ResearchOutputs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        
        if($researchOutput->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('research-outputs.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchOutput $researchOutput)
    {
        
        return view('ResearchOutputs.show', compact('researchOutput'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchOutput $researchOutput)
    {
        return view('ResearchOutputs.edit', compact('researchOutput'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchOutput $researchOutput)
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
        
        if($researchOutput->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('research-outputs.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchOutput $researchOutput)
    {
        if($researchOutput->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('research-outputs.index')->with('status', $message);
    }
}
