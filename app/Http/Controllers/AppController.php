<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\User;
use App\Models\KnowledgeArea;
use App\Models\AcademicProgram;
use App\Models\Project;
use App\Models\Event;
use App\Models\LegalInformation;
use App\Models\EducationalEnvironment;
use App\Models\EducationalTool;

use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Show node dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(User $user, Node $node)
    {
        return view('dashboard');
    }

    /**
     * Display the dashboard company view
     *
     * @return \Illuminate\Http\Response
     */
    public function companyDashboard(Node $node, Request $request)
    {
        $search         = $request->get('search');
        $projects       = Project::all();
        //$allKeywords    = Project::allKeywords($node);

        return view('dashboard-company', compact('node', 'projects', 'search'));
    }

    /**
     * Display the dashboard company view
     *
     * @return \Illuminate\Http\Response
     */
    public function businessObservatory(Node $node, Request $request)
    {
        $search         = $request->get('search');
        $projects       = Project::all();
        //$allKeywords    = Project::allKeywords($node);

        return view('business-observatory', compact('node', 'projects', 'search'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Node $node)
    {
        $knowledgeAreas                             = KnowledgeArea::orderBy('name')->get();
        $node->shuffleProjects                      = $node->shuffleProjects();
        $node->shuffleEducationalInstitutionEvents  = $node->educationalInstitutionAndNodeEvents()->shuffle()->take(2);
        $legalInformations                          = LegalInformation::orderBy('title')->get();

        return view('welcome', compact('node', 'knowledgeAreas', 'legalInformations'));
    }

    /**
     * Display roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles(Node $node)
    {
        $node->academicPrograms = AcademicProgram::select('academic_programs.id', 'academic_programs.name', 'educational_institution_faculties.name as educationalInstitutionFacultyName', 'educational_institutions.name as educationalInstitutionName')->join('educational_institution_faculties', 'academic_programs.educational_institution_faculty_id', 'educational_institution_faculties.id')->join('educational_institutions', 'educational_institution_faculties.educational_institution_id', 'educational_institutions.id')->where('educational_institutions.node_id', $node->id)->get();
        $legalInformations      = LegalInformation::orderBy('title')->get();

        return view('Explorer.Roles.index-roles', compact('node', 'legalInformations'));
    }

    /**
     * Display roles by academic program and educational institution.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchRoles(Node $node, AcademicProgram $academicProgram)
    {
        $node->roleMembers = $academicProgram->educationalInstitutionFaculty->members()->whereHas('userGraduations', function($query) use($academicProgram) {
            return $query->where('graduations.academic_program_id', $academicProgram->id);
        })->get();
        $projects = auth()->user()->projects;

        $legalInformations = LegalInformation::orderBy('title')->get();

        return view('Explorer.Roles.roles-results', compact('node', 'academicProgram', 'projects', 'legalInformations'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUser(Node $node, User $user)
    {
        $projects                       = auth()->user()->projects;
        $memberEducationalInstitution   = $user->educationalInstitutionFaculties()->where('is_principal', 1)->first();
        $legalInformations              = LegalInformation::orderBy('title')->get();

        return view('Explorer.Roles.show-role', compact('node', 'user', 'memberEducationalInstitution', 'projects', 'legalInformations'));
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

        return view('Explorer.Projects.index-projects', compact('node', 'projects', 'search', 'allKeywords'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProject(Node $node, Project $project)
    {
        $legalInformations = LegalInformation::orderBy('title')->get();

        return view('Explorer.Projects.show-project', compact('node', 'project', 'legalInformations'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchEducationalEnvironments(Request $request, Node $node)
    {
        $search                     = $request->get('search-educational-environment');
        $educationalEnvironments    = EducationalEnvironment::searchEducationalEnvironments($search)->get();

        return view('Explorer.EducationalEnvironments.index-educational-environments', compact('node', 'educationalEnvironments', 'search'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEducationalEnvironment(Node $node, EducationalEnvironment $educationalEnvironment)
    {
        $legalInformations = LegalInformation::orderBy('title')->get();

        return view('Explorer.EducationalEnvironments.show-educational-environment', compact('node', 'educationalEnvironment', 'legalInformations'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchEducationalTools(Request $request, Node $node)
    {
        $search              = $request->get('search-educational-tool');
        $educationalTools    = EducationalTool::searchEducationalTools($search)->get();

        return view('Explorer.EducationalTools.index-educational-tools', compact('node', 'educationalTools', 'search'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEducationalTool(Node $node, EducationalTool $educationalTool)
    {
        $legalInformations = LegalInformation::orderBy('title')->get();

        return view('Explorer.EducationalTools.show-educational-tool', compact('node', 'educationalTool', 'legalInformations'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events(Request $request, Node $node)
    {
        $search             = $request->get('search') ?? null;
        $projects           = auth()->user()->projects;
        $node->events       = $node->educationalInstitutionAndNodeEvents($search);
        $legalInformations  = LegalInformation::orderBy('title')->get();

        return view('Explorer.Events.index-events', compact('node', 'projects', 'search', 'legalInformations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function showEvent(Request $request, Node $node, Event $event)
    {
        $projects           = auth()->user()->projects;
        $legalInformations  = LegalInformation::orderBy('title')->get();

        return view('Explorer.Events.show-event', compact('node', 'event', 'projects', 'legalInformations'));
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nodeInfo(Node $node)
    {
        $node->qtyProjectsByCity = $node->qtyProjectsByCity();
        if (count($node->qtyProjectsByCity) > 0) {
            if ($node->qtyProjectsByCity->where('city', 'Manizales')->first()) {
                $node->qtyProjectsManizales = $node->qtyProjectsByCity->where('city', 'Manizales')->first()->city == 'Manizales' ? $node->qtyProjectsByCity->where('city', 'Manizales')->first()->count : 0;
            } else {
                $node->qtyProjectsManizales     = 0;
                $node->qtyProjectsPensilvania   = 0;
            }

            if ($node->qtyProjectsByCity->where('city', 'Pensilvania')->first()) {
                $node->qtyProjectsPensilvania = $node->qtyProjectsByCity->where('city', 'Pensilvania')->first()->city == 'Pensilvania' ? $node->qtyProjectsByCity->where('city', 'Pensilvania')->first()->count : 0;
            } else {
                $node->qtyProjectsManizales     = 0;
                $node->qtyProjectsPensilvania   = 0;
            }
        } else {
            $node->qtyProjectsManizales     = 0;
            $node->qtyProjectsPensilvania   = 0;
        }

        $legalInformations  = LegalInformation::orderBy('title')->get();

        return view('Explorer.show-node', compact('node', 'legalInformations'));
    }
    public function dashboard2(User $user, Node $node)
    {
        return view('dashboard2');
    }
}
