<?php

namespace App\Http\Controllers;

use App\Models\AcademicProgram;
use App\Models\KnowledgeArea;
use App\Models\Node;
use App\Models\EducationalInstitution;

use Illuminate\Http\Request;
use Exception;

class AcademicProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academicPrograms = AcademicProgram::orderBy('name')->paginate(50);
        return view('AcademicPrograms.index', compact('academicPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->paginate(50);
        $nodes = Node::orderBy('administrator_id')->paginate(50);
        $educationalInstitutions = EducationalInstitution::orderBy('name')->paginate(50);
        return view('AcademicPrograms.create', compact('knowledgeAreas','nodes','educationalInstitutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $academicProgram = new AcademicProgram();
        $academicProgram->name              = $request->get('name');
        $academicProgram->code              = $request->get('code');
        $academicProgram->academic_level    = $request->get('academic_level');
        $academicProgram->modality          = $request->get('modality');
        $academicProgram->daytime           = $request->get('daytime');
        $academicProgram->start_date        = $request->get('start_date');
        $academicProgram->end_date          = $request->get('end_date');
        $academicProgram->educationalInstitution()->associate($request->get('educational_institution_id'));

        if($academicProgram->save()) {
            $message = 'Your store processed correctly';
        }

        return redirect()->route('academic-programs.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicProgram $academicProgram)
    {
        return view('AcademicPrograms.show', compact('academicProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicProgram $academicProgram)
    {
        return view('AcademicPrograms.edit', compact('academicProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicProgram $academicProgram)
    {
        $academicProgram->name              = $request->get('name');
        $academicProgram->code              = $request->get('code');
        $academicProgram->academic_level    = $request->get('academic_level');
        $academicProgram->modality          = $request->get('modality');
        $academicProgram->daytime           = $request->get('daytime');
        $academicProgram->start_date        = $request->get('start_date');
        $academicProgram->end_date          = $request->get('end_date');
        $academicProgram->educationalInstitution()->associate($request->get('educational_institution_id'));

        if($academicProgram->save()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('academic-programs.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicProgram $academicProgram)
    {
        if($academicProgram->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('academic-programs.index')->with('status', $message);
    }
}
