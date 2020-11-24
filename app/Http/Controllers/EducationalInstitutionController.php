<?php

namespace App\Http\Controllers;

use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;
use App\Models\Node;

use Illuminate\Http\Request;

class EducationalInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educationalInstitutions = EducationalInstitution::orderBy('name')->paginate(50);
        return view('EducationalInstitutions.index', compact('educationalInstitutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $educationalInstitutionAdmins = DB::table('educational_institution_admins')->get();
        $nodes = Node::orderBy('state')->paginate(50);
        return view('EducationalInstitutions.create', compact('nodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        if($educationalInstitution->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('educational-institutions.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutions.show', compact('educationalInstitution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutions.show', compact('educationalInstitution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalInstitution $educationalInstitution)
    {
        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->administrator()->associate($request->get('administrator_id'));
        $educationalInstitution->node()->associate($request->get('node_id'));

        if($educationalInstitution->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('educational-institutions.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalInstitution $educationalInstitution)
    {
        if($educationalInstitution->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('educational-institutions.index')->with('status', $message);
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

    /**
     * Filter academic programs by educational institution.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function getAcademicPrograms(EducationalInstitution $educationalInstitution)
    {
        return response(['academicPrograms' => $educationalInstitution->academicPrograms()->get()]);
    }

    public function getResearchLines(ResearchGroup $researchGroup)
    {
        return $researchGroup->researchLines()->get();
    }
}