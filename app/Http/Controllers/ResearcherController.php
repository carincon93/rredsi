<?php

namespace App\Http\Controllers;

use App\User;
use App\Researcher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResearcherRequest;
use App\Http\Requests\UpdateResearcherRequest;

class ResearcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Researcher::with('user', 'user.researchTeams')->get();
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
    public function store(StoreResearcherRequest $request)
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
        $researcher->save();

        $researcher->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);

        $researcher->isResearcher()->create([
            'id'            => $researcher->id,
            'cvlac'         => $request->get('cvlac'),
            'is_accepted'   => $request->get('is_accepted'),
        ]);

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
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function show(Researcher $researcher)
    {
        return response()->json($researcher->with('user', 'user.isResearcher', 'user.researchTeams')->where('researchers.id', $researcher->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function edit(Researcher $researcher)
    {
        return response()->json($researcher->user()->with('researchTeams')->with('isResearcher')->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResearcherRequest $request, Researcher $researcher)
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
        $researcher->user->save();

        $researcher->cvlac          = $request->get('cvlac');
        $researcher->is_accepted    = $request->get('is_accepted');
        $researcher->save();

        $researcher->user->researchTeams()->wherePivot('user_id', '=', $researcher->user->id)->detach();
        $researcher->user->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);

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
     * @param  \App\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Researcher $researcher)
    {
        try
        {
            if($researcher->delete()){
                return response()->json('Eliminado');
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return 'Error 23000';
            }
        }
    }
}
