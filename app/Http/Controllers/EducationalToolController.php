<?php

namespace App\Http\Controllers;

use App\Models\EducationalEnvironment;
use App\Models\EducationalTool;
use Illuminate\Http\Request;
use Exception;

class EducationalToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educationalTools = EducationalTool::orderBy('name')->paginate(50);
        return view('EducationalTools.index', compact('educationalTools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $educationalEnvironments = EducationalEnvironment::orderBy('name')->paginate(50);
        return view('EducationalTools.create', compact('educationalEnvironments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $educationalTool = new EducationalTool();
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
        $educationalTool->is_available  = $request->get('is_available');
        $educationalTool->is_enabled    = $request->get('is_enabled');
        $educationalTool->educationalEnvironment()->associate($request->get('educational_environment_id'));

        if($educationalTool->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('educational-tools.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalTool $educationalTool)
    {
        return view('EducationalTools.show', compact('educationalTool'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalTool $educationalTool)
    {
        return view('EducationalTools.show', compact('educationalTool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalTool $educationalTool)
    {
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
        $educationalTool->is_available  = $request->get('is_available');
        $educationalTool->is_enabled    = $request->get('is_enabled');
        $educationalTool->educationalEnvironment()->associate($request->get('educational_environment_id'));

        if($educationalTool->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('educational-tools.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalTool $educationalTool)
    {
        if($educationalTool->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('educational-tools.index')->with('status', $message);

    }
}
