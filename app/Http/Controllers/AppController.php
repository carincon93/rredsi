<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\User;
use App\Models\KnowledgeArea;
use App\Models\AcademicProgram;
use App\Models\Project;
use App\Models\Event;

use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Show node dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Node $node)
    {
        return view('dashboard', compact('node'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Node $node)
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        $node->shuffleProjects      = $node->shuffleProjects();
        $node->qtyProjectsByCity    = $node->qtyProjectsByCity();
        $node->shuffleEducationalInstitutionEvents = $node->educationalInstitutionAndNodeEvents()->shuffle()->take(2);

        if (count($node->qtyProjectsByCity) > 0) {
            $node->qtyProjectsManizales     = $node->qtyProjectsByCity->where('city', 'Manizales')->first()->city == 'Manizales' ? $node->qtyProjectsByCity->where('city', 'Manizales')->first()->count : 0;
            $node->qtyProjectsPensilvania   = $node->qtyProjectsByCity->where('city', 'Pensilvania')->first()->city == 'Pensilvania' ? $node->qtyProjectsByCity->where('city', 'Pensilvania')->first()->count : 0;
        } else {
            $node->qtyProjectsManizales     = 0;
            $node->qtyProjectsPensilvania   = 0;
        }

        return view('welcome', compact('node', 'knowledgeAreas'));
    }

    /**
     * Display roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles(Node $node)
    {
        $node->academicPrograms = $node->educationalInstitutions()->with('academicPrograms')->get()->pluck('academicPrograms')->flatten();

        return view('Explorer.index-roles', compact('node'));
    }

    /**
     * Display roles by academic program and educational institution.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchRoles(Node $node, AcademicProgram $academicProgram)
    {
        $node->roleMembers = $academicProgram->educationalInstitution->members()->whereHas('userGraduations', function($query) use($academicProgram) {
            return $query->where('graduations.academic_program_id', $academicProgram->id);
        })->get();
        $projects = auth()->user()->projects;

        return view('Explorer.index-role-members', compact('node', 'academicProgram', 'projects'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProjects(Request $request, Node $node)
    {
        $search         = $request->get('search');
        $projects       = Project::searchProjects($search)->get();
        $allKeywords    = Project::allKeywords($node);
        
        return view('Explorer.index-projects', compact('node', 'projects', 'search', 'allKeywords'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProject(Node $node, Project $project)
    {
        return view('Explorer.show-project', compact('node', 'project'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events(Request $request, Node $node)
    {
        $search     = $request->get('search') ?? null;
        $projects   = auth()->user()->projects;

        $node->events = $node->educationalInstitutionAndNodeEvents($search);

        return view('Explorer.index-events', compact('node', 'projects', 'search'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function showEvent(Request $request, Node $node, Event $event)
    {
        $projects = auth()->user()->projects;

        return view('Explorer.show-event', compact('node', 'event', 'projects'));
    }
}
