<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\EducationalInstitution;
use Illuminate\Http\Request;

class EducationalInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node)
    {
        $educationalInstitutions = $node->educationalInstitutions()->get();

        return response(['educationalInstitutions' => $educationalInstitutions]);
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
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalInstitution $educationalInstitution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalInstitution $educationalInstitution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalInstitution $educationalInstitution)
    {
        //
    }
}
