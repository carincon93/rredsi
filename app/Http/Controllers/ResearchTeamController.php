<?php

namespace App\Http\Controllers;

use App\ResearchTeam;
use Illuminate\Http\Request;
use App\Http\Requests\ResearchTeamRequest;
use Exception;

class ResearchTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return ResearchTeam::with('researchGroup', 'administrator', 'administrator.educationalInstitution', 'knowledgeAreas')->get();
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
    public function store(ResearchTeamRequest $request)
    {
        $researchTeam = new ResearchTeam();
        $researchTeam->name                             = $request->get('name');
        $researchTeam->mentor_name                      = $request->get('mentor_name');
        $researchTeam->mentor_email                     = $request->get('mentor_email');
        $researchTeam->mentor_cellphone                 = $request->get('mentor_cellphone');
        $researchTeam->overall_objective                = $request->get('overall_objective');
        $researchTeam->mission                          = $request->get('mission');
        $researchTeam->vision                           = $request->get('vision');
        $researchTeam->regional_projection              = $request->get('regional_projection');
        $researchTeam->knowledge_production_strategy    = $request->get('knowledge_production_strategy');
        $researchTeam->thematic_research                = $request->get('thematic_research');
        $researchTeam->creation_date                    = $request->get('creation_date');

        $researchTeam->administrator()->associate($request->get('administrator_id'));
        $researchTeam->researchGroup()->associate($request->get('research_group_id'));
        $researchTeam->studentLeader()->associate($request->get('student_leader_id'));
        $researchTeam->save();

        $researchTeam->academicPrograms()->attach($request->get('academic_program_id'));
        $researchTeam->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $researchTeam->researchLines()->attach($request->get('research_line_id'));

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
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchTeam $researchTeam)
    {
        return response()->json($researchTeam->with('administrator.user', 'researchGroup', 'researchLines', 'knowledgeAreas', 'studentLeader.user')->where('research_teams.id', $researchTeam->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchTeam $researchTeam)
    {
        return response()->json($researchTeam->with('administrator.user', 'researchGroup', 'researchLines', 'knowledgeAreas')->where('research_teams.id', $researchTeam->id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchTeamRequest $request, ResearchTeam $researchTeam)
    {
        $researchTeam->name                             = $request->get('name');
        $researchTeam->mentor_name                      = $request->get('mentor_name');
        $researchTeam->mentor_email                     = $request->get('mentor_email');
        $researchTeam->mentor_cellphone                 = $request->get('mentor_cellphone');
        $researchTeam->overall_objective                = $request->get('overall_objective');
        $researchTeam->mission                          = $request->get('mission');
        $researchTeam->vision                           = $request->get('vision');
        $researchTeam->regional_projection              = $request->get('regional_projection');
        $researchTeam->knowledge_production_strategy    = $request->get('knowledge_production_strategy');
        $researchTeam->thematic_research                = $request->get('thematic_research');
        $researchTeam->creation_date                    = $request->get('creation_date');

        $researchTeam->administrator()->associate($request->get('administrator_id'));
        $researchTeam->researchGroup()->associate($request->get('research_group_id'));
        $researchTeam->studentLeader()->associate($request->get('student_leader_id'));
        $researchTeam->save();

        $researchTeam->academicPrograms()->wherePivot('research_team_id', '=', $researchTeam->id)->detach();
        $researchTeam->academicPrograms()->attach($request->get('academic_program_id'));
        $researchTeam->knowledgeAreas()->wherePivot('research_team_id', '=', $researchTeam->id)->detach();
        $researchTeam->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $researchTeam->researchLines()->wherePivot('research_team_id', '=', $researchTeam->id)->detach();
        $researchTeam->researchLines()->attach($request->get('research_line_id'));

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
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchTeam $researchTeam)
    {
        try
        {
            if($researchTeam->delete()){
                return response()->json(['message'=>'Eliminado correctamente']);
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
