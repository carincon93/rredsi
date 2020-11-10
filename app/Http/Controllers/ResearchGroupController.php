<?php

namespace App\Http\Controllers;

use App\ResearchGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResearchGroupRequest;
use App\Http\Requests\UpdateResearchGroupRequest;

class ResearchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResearchGroup::with('educationalInstitution')->get();
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
    public function store(StoreResearchGroupRequest $request)
    {
        $researchGroup = new ResearchGroup();
        $researchGroup->name                    = $request->get('name');
        $researchGroup->email                   = $request->get('email');
        $researchGroup->leader                  = $request->get('leader');
        $researchGroup->gruplac                 = $request->get('gruplac');
        $researchGroup->minciencias_code        = $request->get('minciencias_code');
        $researchGroup->minciencias_category    = $request->get('minciencias_category');
        $researchGroup->website                 = $request->get('website');
        $researchGroup->educationalInstitution()->associate($request->get('educational_institution_id'));
        $researchGroup->save();

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
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchGroup $researchGroup)
    {
        return response()->json($researchGroup);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchGroup $researchGroup)
    {
        return response()->json($researchGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResearchGroupRequest $request, ResearchGroup $researchGroup)
    {
        $researchGroup->name                    = $request->get('name');
        $researchGroup->email                   = $request->get('email');
        $researchGroup->leader                  = $request->get('leader');
        $researchGroup->gruplac                 = $request->get('gruplac');
        $researchGroup->minciencias_code        = $request->get('minciencias_code');
        $researchGroup->minciencias_category    = $request->get('minciencias_category');
        $researchGroup->website                 = $request->get('website');
        $researchGroup->educationalInstitution()->associate($request->get('educational_institution_id'));
        $researchGroup->save();

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
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchGroup $researchGroup)
    {
        try
        {
            if($researchGroup->delete()){
                return 'Eliminado';
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return 'Error 23000';
            }
        }
    }

    /**
     * Get research teams by research group.
     *
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function getResearchTeams(ResearchGroup $researchGroup)
    {
        return $researchGroup->researchTeams()->get();
    }
}
