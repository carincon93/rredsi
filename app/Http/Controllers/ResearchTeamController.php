<?php

namespace App\Http\Controllers;

use App\Models\ResearchTeam;
use App\Models\KnowledgeArea;
use App\Models\EducationalInstitution;
use App\Models\AcademicProgram;
use App\Models\ResearchGroup;
use App\Models\ResearchLine;

use Illuminate\Http\Request;
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
        $researchTeams = ResearchTeam::orderBy('name')->paginate(50);
        return view('ResearchTeams.index', compact('researchTeams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->paginate(50);
        $educationalInstitutions = EducationalInstitution::orderBy('name')->paginate(50);
        $academicPrograms = AcademicProgram::orderBy('name')->paginate(50);
        $researchGroups = ResearchGroup::orderBy('name')->paginate(50);
        $researchLines = ResearchLine::orderBy('name')->paginate(50);
        return view('ResearchTeams.create', compact('knowledgeAreas','educationalInstitutions','academicPrograms','researchGroups','researchLines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        if($researchTeam->save()){
            $message = 'Your store processed correctly';
        }

        $researchTeam->academicPrograms()->attach($request->get('academic_program_id'));
        $researchTeam->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $researchTeam->researchLines()->attach($request->get('research_line_id'));

        return redirect()->route('research-teams.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchTeam $researchTeam)
    {
        return view('ResearchTeams.show', compact('researchTeam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchTeam $researchTeam)
    {
        return view('ResearchTeams.edit', compact('researchTeam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchTeam $researchTeam)
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

        if($researchTeam->save()){
            $message = 'Your update processed correctly';
        }

        $researchTeam->academicPrograms()->wherePivot('research_team_id', '=', $researchTeam->id)->detach();
        $researchTeam->academicPrograms()->attach($request->get('academic_program_id'));
        $researchTeam->knowledgeAreas()->wherePivot('research_team_id', '=', $researchTeam->id)->detach();
        $researchTeam->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $researchTeam->researchLines()->wherePivot('research_team_id', '=', $researchTeam->id)->detach();
        $researchTeam->researchLines()->attach($request->get('research_line_id'));

        return redirect()->route('research-teams.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchTeam $researchTeam)
    {
        if($researchTeam->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('research-teams.index')->with('status', $message);
    }
}
