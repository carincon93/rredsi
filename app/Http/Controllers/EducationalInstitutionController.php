<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;

use App\Http\Requests\EducationalInstitutionRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EducationalInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node)
    {
        $educationalInstitutions = $node->educationalInstitutions()->orderBy('name')->get();

        return view('EducationalInstitutions.index', compact('node', 'educationalInstitutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node)
    {
        $cities = json_decode(Storage::get('public/json/caldas_cities.json'), true);

        return view('EducationalInstitutions.create', compact('node', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalInstitutionRequest $request, Node $node)
    {
        $educationalInstitution = new EducationalInstitution();
        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->node()->associate($node);

        if($educationalInstitution->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutions.show', compact('node', 'educationalInstitution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution)
    {
        $cities = json_decode(Storage::get('public/json/caldas_cities.json'), true);

        return view('EducationalInstitutions.edit', compact('node', 'educationalInstitution', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalInstitutionRequest $request, Node $node, EducationalInstitution $educationalInstitution)
    {
        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->node()->associate($node);

        if($educationalInstitution->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
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

        return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
    }

    /**
     * Display a dashboard of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Node $node, EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutions.dashboard', compact('node', 'educationalInstitution'));
    }

    /**
     * Display BI.
     *
     * @return \Illuminate\Http\Response
     */
    public function bi(Node $node, EducationalInstitution $educationalInstitution)
    {
        $educationalInstitution->projectsByKnowledgeArea        = $educationalInstitution->projectsByKnowledgeArea();
        $educationalInstitution->projectsByYear                 = $educationalInstitution->projectsByYear();
        $educationalInstitution->projectsByProjectTypes         = $educationalInstitution->projectsByProjectTypes();
        $educationalInstitution->eventsAndProjects              = $educationalInstitution->eventsAndProjects();

        return view('EducationalInstitutions.bi', compact('node', 'educationalInstitution'));
    }
}
