<?php

namespace App\Http\Controllers;

use App\EducationalInstitution;
use App\ResearchGroup;
use App\Http\Requests\StoreEducationalInstitutionRequest;
use App\Http\Requests\UpdateEducationalInstitutionRequest;
use Exception;

class EducationalInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EducationalInstitution::with('node', 'administrator.user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEducationalInstitutionRequest $request)
    {
        $educationalInstitution = new EducationalInstitution();
        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->administrator()->associate($request->get('administrator_id'));
        $educationalInstitution->node()->associate($request->get('node_id'));
        $educationalInstitution->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your store processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalInstitution $educationalInstitution)
    {
        return response()->json( $educationalInstitution->with('administrator.user')->where('educational_institutions.id', $educationalInstitution->id)->first() );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalInstitution $educationalInstitution)
    {
        return response()->json($educationalInstitution);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEducationalInstitutionRequest $request, EducationalInstitution $educationalInstitution)
    {
        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->administrator()->associate($request->get('administrator_id'));
        $educationalInstitution->node()->associate($request->get('node_id'));
        $educationalInstitution->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your update processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalInstitution $educationalInstitution)
    {
        try
        {
            if($educationalInstitution->delete()){
                return response()->json('Eliminado');
            }
        } catch (Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return response()->json('Error 23000');
            }
        }
    }

    /**
     * Get research groups by educational institution.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function getResearchGroups(EducationalInstitution $educationalInstitution)
    {
        return $educationalInstitution->researchGroups()->get();
    }

    public function getAcademicPrograms(EducationalInstitution $educationalInstitution)
    {
        return $educationalInstitution->academicPrograms()->get();
    }

    public function getResearchLines(ResearchGroup $researchGroup)
    {
        return $researchGroup->researchLines()->get();
    }
}
