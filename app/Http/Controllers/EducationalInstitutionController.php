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
    public function index(Node $node)
    {
        $educationalInstitutions = $node->educationalInstitutions->orderBy('name')->paginate(50);

        return view('EducationalInstitutions.index', compact('educationalInstitutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node)
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
    public function store(Request $request, Node $node)
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
    public function show(Node $node, EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutions.show', compact('educationalInstitution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution)
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
    public function update(Request $request, Node $node, EducationalInstitution $educationalInstitution)
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
    public function destroy(Node $node, EducationalInstitution $educationalInstitution)
    {
        if($educationalInstitution->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('educational-institutions.index')->with('status', $message);
    }

    /**
     * Display a dashboard of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Node $node, EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutions.dashboard', compact('educationalInstitution'));
    }

    public function getResearchLines(ResearchGroup $researchGroup)
    {
        return $researchGroup->researchLines()->get();
    }

    /**
     * Get research groups by educational institution.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function getResearchGroups(Node $node, EducationalInstitution $educationalInstitution)
    {
        return $educationalInstitution->researchGroups()->get();
    }

    /**
     * Filter academic programs by educational institution.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function getAcademicPrograms(Node $node, EducationalInstitution $educationalInstitution)
    {
        return response(['academicPrograms' => $educationalInstitution->academicPrograms()->get()]);
    }
}
