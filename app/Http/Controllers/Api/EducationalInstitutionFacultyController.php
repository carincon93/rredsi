<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use Illuminate\Http\Request;

class EducationalInstitutionFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution)
    {
        $educationalInstitutionFaculties = $educationalInstitution->educationalInstitutionFaculties()->get();

        return response(['educationalInstitutionFaculties' => $educationalInstitutionFaculties]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EducationalInstitutionFaculty  $EducationalInstitutionFaculty
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalInstitutionFaculty $EducationalInstitutionFaculty)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $KnowledgeSubareaDiscipline
     * @return \Illuminate\Http\EducationalInstitutionFaculty
     */
    public function show(EducationalInstitutionFaculty $EducationalInstitutionFaculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnowledgeSubareaDiscipline  $KnowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalInstitutionFaculty $EducationalInstitutionFaculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KnowledgeSubareaDiscipline  $KnowledgeSubareaDiscipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalInstitutionFaculty $EducationalInstitutionFaculty)
    {
        //
    }
}
