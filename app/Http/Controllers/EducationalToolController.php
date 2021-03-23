<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
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
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('viewAny', [EducationalTool::class]);

        $educationalTools = $educationalEnvironment->educationalTools()->orderBy('name')->get();

        return view('EducationalTools.index', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironment', 'educationalTools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('create', [EducationalTool::class]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('EducationalTools.create', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironment', 'knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalToolRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment)
    {
        $this->authorize('create', [EducationalTool::class]);

        $educationalTool = new EducationalTool();
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
         // ? asociamos la herramienta educativa al ambiente de formación
        $educationalTool->educationalEnvironment()->associate($educationalEnvironment);

        if ($educationalTool->save()) {
            $educationalTool->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_discipline_id'));
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.educational-environments.educational-tools.index', [$node, $educationalInstitution, $faculty, $educationalEnvironment])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        $this->authorize('view', [EducationalTool::class]);

        return view('EducationalTools.show', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironment', 'educationalTool'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        $this->authorize('update', [EducationalTool::class]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('EducationalTools.edit', compact('node', 'educationalInstitution', 'faculty', 'educationalEnvironment', 'educationalTool', 'knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalToolRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        $this->authorize('update', [EducationalTool::class]);

        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
         // ? asociamos la herramienta educativa al ambiente de formación
        $educationalTool->educationalEnvironment()->associate($educationalEnvironment);

        if ($educationalTool->save()) {
            $educationalTool->knowledgeSubareaDisciplines()->sync($request->get('knowledge_subarea_discipline_id'));
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.educational-environments.educational-tools.index', [$node, $educationalInstitution, $faculty, $educationalEnvironment])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, EducationalEnvironment $educationalEnvironment, EducationalTool $educationalTool)
    {
        $this->authorize('delete', [EducationalTool::class]);

        if($educationalTool->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.educational-environments.educational-tools.index', [$node, $educationalInstitution, $faculty, $educationalEnvironment])->with('status', $message);
    }
}
