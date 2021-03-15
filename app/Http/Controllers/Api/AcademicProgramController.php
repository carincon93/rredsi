<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use App\Models\AcademicProgram;
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
        $academicPrograms = $faculty->academicPrograms()->get();

        return response(['academicPrograms' => $academicPrograms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicProgram $academicProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicProgram $academicProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicProgram $academicProgram)
    {
        //
    }
}
