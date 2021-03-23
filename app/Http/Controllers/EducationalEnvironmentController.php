<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalEnvironment;
use App\Models\EducationalInstitutionFaculty;
use App\Models\KnowledgeArea;

use App\Http\Requests\EducationalEnvironmentRequest;
use Illuminate\Http\Request;

class EducationalEnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('viewAny',[EducationalEnvironment::class, $educationalInstitution]);

        $educationalEnvironments = $faculty->educationalEnvironments()->orderBy('name')->get();

        return view('EducationalEnvironments.index', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('create', [EducationalEnvironment::class, $educationalInstitution]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('EducationalEnvironments.create', compact('node', 'educationalInstitution', 'faculty', 'knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalEnvironmentRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('create', [EducationalEnvironment::class, $educationalInstitution]);

        $educationalEnvironment = new EducationalEnvironment();
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        // ? asociamos el ambiente de formacion con la facultad
        $educationalEnvironment->educationalInstitutionFaculty()->associate($faculty);

        if($educationalEnvironment->save()){
            $educationalEnvironment->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_discipline_id'));
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('view', [EducationalEnvironment::class, $educationalInstitution]);

        return view('EducationalEnvironments.show', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('update', [EducationalEnvironment::class, $educationalInstitution]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('EducationalEnvironments.edit', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironment', 'knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalEnvironmentRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('update', [EducationalEnvironment::class, $educationalInstitution]);

        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        // ? asociamos el ambiente de formacion con la facultad
        $educationalEnvironment->educationalInstitutionFaculty()->associate($faculty);

        if($educationalEnvironment->save()) {
            $educationalEnvironment->knowledgeSubareaDisciplines()->sync($request->get('knowledge_subarea_discipline_id'));
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('delete', [EducationalEnvironment::class, $educationalInstitution]);

        if($educationalEnvironment->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }
}
