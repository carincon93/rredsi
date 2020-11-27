<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalEnvironment;
use App\Models\EducationalTool;
use App\Http\Requests\EducationalToolRequest;
use Illuminate\Http\Request;

class EducationalToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        $educationalTools = $educationalEnvironment->educationalTools()->orderBy('name')->get();

        return view('EducationalTools.index', compact('node', 'educationalInstitution', 'educationalEnvironment', 'educationalTools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        return view('EducationalTools.create', compact('node', 'educationalInstitution', 'educationalEnvironment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalToolRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        $educationalTool = new EducationalTool();
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
        $educationalTool->is_available  = $request->get('is_available');
        $educationalTool->is_enabled    = $request->get('is_enabled');
        $educationalTool->educationalEnvironment()->associate($educationalEnvironment);

        if($educationalTool->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.educational-environments.educational-tools.index', [$node, $educationalInstitution, $educationalEnvironment])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        return view('EducationalTools.show', compact('node', 'educationalInstitution', 'educationalEnvironment','educationalTool'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        return view('EducationalTools.edit', compact('node', 'educationalInstitution', 'educationalEnvironment','educationalTool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalToolRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
        $educationalTool->is_available  = $request->get('is_available');
        $educationalTool->is_enabled    = $request->get('is_enabled');
        $educationalTool->educationalEnvironment()->associate($educationalEnvironment);

        if($educationalTool->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.educational-environments.educational-tools.index', [$node, $educationalInstitution, $educationalEnvironment])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        if($educationalTool->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.educational-environments.educational-tools.index', [$node, $educationalInstitution, $educationalEnvironment])->with('status', $message);

    }
}
