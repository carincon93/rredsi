<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use Illuminate\Http\Request;

class ResearchTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node,EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {

        $researchTeams  = $faculty->researchGroups->map(function ($researchGroup) {
            return $researchGroup->researchTeams()->orderBy('name')->get();
        });

        $researchTeams->all();

        return response(['researchTeams' => $researchTeams]);
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
