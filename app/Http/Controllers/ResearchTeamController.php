<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;
use App\Models\ResearchLine;
use App\Models\ResearchTeam;

use App\Http\Requests\ResearchTeamRequest;
use Illuminate\Http\Request;

class ResearchTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup)
    {
        $researchTeams = $researchGroup->researchTeams()->orderBy('name')->get();

        return view('ResearchTeams.index', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup)
    {
        $knowledgeAreas   = KnowledgeArea::orderBy('name')->get();
        $academicPrograms = $educationalInstitution->academicPrograms()->orderBy('name')->get();
        $researchLines    = $researchGroup->researchLines()->orderBy('name')->get();
        $educationalInstitutionMembers = $educationalInstitution->members()->get();

        return view('ResearchTeams.create', compact('node', 'educationalInstitution', 'researchGroup', 'knowledgeAreas', 'academicPrograms', 'researchLines', 'educationalInstitutionMembers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchTeamRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup)
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
        $researchTeam->researchGroup()->associate($researchGroup);

        if($researchTeam->save()){
            $message = 'Your store processed correctly';
        }

        $researchTeam->academicPrograms()->attach($request->get('academic_program_id'));
        $researchTeam->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $researchTeam->researchLines()->attach($request->get('research_line_id'));

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.index', [$node, $educationalInstitution, $researchGroup, $researchLine])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchLine $researchLine, ResearchTeam $researchTeam)
    {
        return view('ResearchTeams.show', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchLine $researchLine, ResearchTeam $researchTeam)
    {
        $knowledgeAreas   = KnowledgeArea::orderBy('name')->get();
        $academicPrograms = $educationalInstitution->academicPrograms()->orderBy('name')->get();
        $researchLines    = $researchGroup->researchLines()->orderBy('name')->get();
        $educationalInstitutionMembers = $educationalInstitution->members()->get();

        return view('ResearchTeams.edit', compact('node', 'educationalInstitution', 'researchGroup', 'researchTeam', 'knowledgeAreas',  'academicPrograms', 'researchLines', 'educationalInstitutionMembers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchTeamRequest $request, Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
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
        $researchTeam->researchGroup()->associate($researchGroup);

        if($researchTeam->save()){
            $message = 'Your update processed correctly';
        }

        $researchTeam->academicPrograms()->attach($request->get('academic_program_id'));
        $researchTeam->knowledgeAreas()->attach($request->get('knowledge_area_id'));
        $researchTeam->researchLines()->attach($request->get('research_line_id'));

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.index', [$node, $educationalInstitution, $researchGroup])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchTeam  $researchTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, ResearchGroup $researchGroup, ResearchTeam $researchTeam)
    {
        if($researchTeam->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.research-groups.research-teams.index', [$node, $educationalInstitution, $researchGroup])->with('status', $message);
    }
}
