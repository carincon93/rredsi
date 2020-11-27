<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Researcher;
use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;
use App\Models\ResearchTeam;

use Illuminate\Http\Request;
use App\Http\Requests\ResearcherRequest;

class ResearcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researchers = Researcher::orderBy('name')->get();
        return view('Researchers.index', compact('researchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educationalInstitutions = EducationalInstitution::orderBy('name');
        $researchGroups = ResearchGroup::orderBy('name');
        $researchTeams = ResearchTeam::orderBy('name');
        return view('Researchers.create', compact('educationalInstitutions','researchGroups','researchTeams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearcherRequest $request)
    {
        $researcher = new User();
        $researcher->name               = $request->get('name');
        $researcher->email              = $request->get('email');
        $researcher->password           = bcrypt($request->get('document_number'));
        $researcher->document_type      = $request->get('document_type');
        $researcher->document_number    = $request->get('document_number');
        $researcher->cellphone_number   = $request->get('cellphone_number');
        $researcher->status             = $request->get('status');
        $researcher->interests          = $request->get('interests');
        $researcher->is_enabled         = $request->get('is_enabled');
        $researcher->role()->associate($request->get('role_id'));

        if($researcher->save()){
            $message = 'Your store processed correctly';
        }

        $researcher->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);

        $researcher->isResearcher()->create([
            'id'            => $researcher->id,
            'cvlac'         => $request->get('cvlac'),
            'is_accepted'   => $request->get('is_accepted'),
        ]);

        return redirect()->route('researchers.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function show(Researcher $researcher)
    {
       return view('Researchers.show', compact('researcher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function edit(Researcher $researcher)
    {
       return view('Researchers.edit', compact('researcher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function update(ResearcherRequest $request, Researcher $researcher)
    {
        $researcher->user->name               = $request->get('name');
        $researcher->user->email              = $request->get('email');
        $researcher->user->password           = bcrypt($request->get('document_number'));
        $researcher->user->document_type      = $request->get('document_type');
        $researcher->user->document_number    = $request->get('document_number');
        $researcher->user->cellphone_number   = $request->get('cellphone_number');
        $researcher->user->status             = $request->get('status');
        $researcher->user->interests          = $request->get('interests');
        $researcher->user->is_enabled         = $request->get('is_enabled');
        $researcher->user->role()->associate($request->get('role_id'));

        if($researcher->save()){
            $message = 'Your update processed correctly';
        }

        $researcher->cvlac          = $request->get('cvlac');
        $researcher->is_accepted    = $request->get('is_accepted');

        $researcher->user->researchTeams()->wherePivot('user_id', '=', $researcher->user->id)->detach();
        $researcher->user->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);

        return redirect()->route('researchers.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Researcher $researcher)
    {
        if($researcher->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('researchers.index')->with('status', $message);
    }
}
