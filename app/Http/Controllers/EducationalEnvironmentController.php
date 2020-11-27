<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalEnvironment;
use App\Http\Requests\EducationalEnvironmentRequest;
use Illuminate\Http\Request;

class EducationalEnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution)
    {
        $educationalEnvironments = $educationalInstitution->educationalEnvironments()->orderBy('name')->get();

        return view('EducationalEnvironments.index', compact('node', 'educationalInstitution', 'educationalEnvironments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution)
    {
        return view('EducationalEnvironments.create', compact('node', 'educationalInstitution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalEnvironmentRequest $request, Node $node, EducationalInstitution $educationalInstitution)
    {
        $educationalEnvironment = new EducationalEnvironment();
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        $educationalEnvironment->is_enabled     = $request->get('is_enabled');
        $educationalEnvironment->is_available   = $request->get('is_available');
        $educationalEnvironment->educationalInstitution()->associate($educationalInstitution);

        if($educationalEnvironment->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.educational-environments.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        return view('EducationalEnvironments.show', compact('node', 'educationalInstitution', 'educationalEnvironment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        return view('EducationalEnvironments.edit', compact('node', 'educationalInstitution', 'educationalEnvironment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalEnvironmentRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        $educationalEnvironment->is_enabled     = $request->get('is_enabled');
        $educationalEnvironment->is_available   = $request->get('is_available');
        $educationalEnvironment->educationalInstitution()->associate($educationalInstitution);

        if($educationalEnvironment->save()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.educational-environments.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalEnvironment $educationalEnvironment)
    {
        if($educationalEnvironment->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.educational-environments.index', [$node, $educationalInstitution])->with('status', $message);
    }
}
