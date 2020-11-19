<?php

namespace App\Http\Controllers;

use App\EducationalEnvironment;
use Illuminate\Http\Request;
use Exception;

class EducationalEnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educationalEnvironments = EducationalEnvironment::orderBy('name')->paginate(50);
        return view('EducationalEnvironments.index', compact('educationalEnvironments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('EducationalEnvironments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $educationalEnvironment = new EducationalEnvironment();
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        $educationalEnvironment->is_enabled     = $request->get('is_enabled');
        $educationalEnvironment->is_available   = $request->get('is_available');
        $educationalEnvironment->educationalInstitution()->associate($request->get('educational_institution_id'));
        
        if($educationalEnvironment->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('educational-environments.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalEnvironment $educationalEnvironment)
    {
        return view('EducationalEnvironments.show', compact('educationalEnvironment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalEnvironment $educationalEnvironment)
    {
        return view('EducationalEnvironments.edit', compact('educationalEnvironment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalEnvironment $educationalEnvironment)
    {
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        $educationalEnvironment->is_enabled     = $request->get('is_enabled');
        $educationalEnvironment->is_available   = $request->get('is_available');
        $educationalEnvironment->educationalInstitution()->associate($request->get('educational_institution_id'));
        
        if($educationalEnvironment->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('educational-environments.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalEnvironment $educationalEnvironment)
    {
        if($educationalEnvironment->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('educational-environments.index')->with('status', $message);
    }

    public function getByEducationalInstitution(Request $request, $id)
    {
        return EducationalEnvironment::with('educationalInstitution')->where('educational_institution_id', '=', $id)->get();
    }
}
