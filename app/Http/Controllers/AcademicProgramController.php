<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicProgramRequest;
use App\Models\AcademicProgram;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;

use Illuminate\Http\Request;

class AcademicProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $academicPrograms = $faculty->academicPrograms()->orderBy('name')->get();

        return view('AcademicPrograms.index', compact('node', 'educationalInstitution', 'faculty', 'academicPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        return view('AcademicPrograms.create', compact('node', 'educationalInstitution', 'faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicProgramRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $academicProgram = new AcademicProgram();
        $academicProgram->name              = $request->get('name');
        $academicProgram->code              = $request->get('code');
        $academicProgram->academic_level    = $request->get('academic_level');
        $academicProgram->modality          = $request->get('modality');
        $academicProgram->daytime           = $request->get('daytime');
        $academicProgram->start_date        = $request->get('start_date');
        $academicProgram->end_date          = $request->get('end_date');
        $academicProgram->educationalInstitutionFaculty()->associate($faculty);

        if($academicProgram->save()) {
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, AcademicProgram $academicProgram)
    {
        return view('AcademicPrograms.show', compact('node', 'educationalInstitution', 'faculty', 'academicProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, AcademicProgram $academicProgram)
    {
        return view('AcademicPrograms.edit', compact('node', 'educationalInstitution', 'faculty', 'academicProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicProgramRequest $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, AcademicProgram $academicProgram)
    {
        $academicProgram->name              = $request->get('name');
        $academicProgram->code              = $request->get('code');
        $academicProgram->academic_level    = $request->get('academic_level');
        $academicProgram->modality          = $request->get('modality');
        $academicProgram->daytime           = $request->get('daytime');
        $academicProgram->start_date        = $request->get('start_date');
        $academicProgram->end_date          = $request->get('end_date');
        $academicProgram->educationalInstitutionFaculty()->associate($faculty);

        if($academicProgram->save()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty, AcademicProgram $academicProgram)
    {
        if($academicProgram->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $faculty])->with('status', $message);
    }
}
