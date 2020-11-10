<?php

namespace App\Http\Controllers;

use App\User;
use App\ResearchTeamAdmin;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreResearchTeamAdminRequest;
use App\Http\Requests\UpdateResearchTeamAdminRequest;
use Facade\Ignition\QueryRecorder\Query;

class ResearchTeamAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResearchTeamAdmin::with('user', 'educationalInstitution', 'isResearchTeamAdmin')->get();
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
    public function store(StoreResearchTeamAdminRequest $request)
    {
        $researchTeamAdmin = new User();
        $researchTeamAdmin->name               = $request->get('name');
        $researchTeamAdmin->email              = $request->get('email');
        $researchTeamAdmin->password           = bcrypt($request->get('document_number'));
        $researchTeamAdmin->document_type      = $request->get('document_type');
        $researchTeamAdmin->document_number    = $request->get('document_number');
        $researchTeamAdmin->cellphone_number   = $request->get('cellphone_number');
        $researchTeamAdmin->status             = $request->get('status');
        $researchTeamAdmin->interests          = $request->get('interests');
        $researchTeamAdmin->is_enabled         = $request->get('is_enabled');
        $researchTeamAdmin->role()->associate($request->get('role_id'));
        $researchTeamAdmin->save();

        $researchTeamAdmin->isResearchTeamAdmin()->create([
            'id'                            => $researchTeamAdmin->id,
            'educational_institution_id'    => $request->get('educational_institution_id'),
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
     * @param  \App\ResearchTeamAdmin  $researchTeamAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchTeamAdmin $researchTeamAdmin)
    { 
        return response()->json($researchTeamAdmin->with('user', 'isResearchTeamAdmin')->where('research_team_admins.id', $researchTeamAdmin->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchTeamAdmin  $researchTeamAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchTeamAdmin $researchTeamAdmin)
    {
        return response()->json($researchTeamAdmin->with('user', 'isResearchTeamAdmin')->where('research_team_admins.id', $researchTeamAdmin->id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $researchTeamAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResearchTeamAdminRequest $request, User $researchTeamAdmin)
    {
        $researchTeamAdmin->name               = $request->get('name');
        $researchTeamAdmin->email              = $request->get('email');
        $researchTeamAdmin->password           = bcrypt($request->get('document_number'));
        $researchTeamAdmin->document_type      = $request->get('document_type');
        $researchTeamAdmin->document_number    = $request->get('document_number');
        $researchTeamAdmin->cellphone_number   = $request->get('cellphone_number');
        $researchTeamAdmin->status             = $request->get('status');
        $researchTeamAdmin->interests          = $request->get('interests');
        $researchTeamAdmin->is_enabled         = $request->get('is_enabled');
        $researchTeamAdmin->role()->associate($request->get('role_id'));
        $researchTeamAdmin->isResearchTeamAdmin()->update([
            'educational_institution_id'    => $request->get('educational_institution_id'),
        ]);
        $researchTeamAdmin->save();

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
     * @param  \App\ResearchTeamAdmin  $researchTeamAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchTeamAdmin $researchTeamAdmin)
    {
        try {
            if($researchTeamAdmin->isResearchTeamAdmin){
                return response()->json(['message'=>'Tiene a cargo un semillero, no se puede eliminar']);
            }
            $researchTeamAdmin->delete();
            return response()->json([
                'message' => 'Administrador de semillero eliminado',
                'status' => 200
            ]);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
}
