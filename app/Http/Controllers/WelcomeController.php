<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\User;
use App\Models\KnowledgeArea;
use App\Models\AcademicProgram;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node)
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        $node->shuffleProjects      = $node->shuffleProjects();
        $node->qtyProjectsByCity    = $node->qtyProjectsByCity();
        $node->shuffleEducationalInstitutionEvents = $node->shuffleEducationalInstitutionEvents();

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
        $node->roleMembers = $academicProgram->educationalInstitution->members;

        return view('Explorer.index-role-members', compact('node', 'academicProgram'));
    }

    /**
     * Show contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactForm(Node $node, User $user)
    {
        $projects = auth()->user()->projects;

        return view('Explorer.contact-form', compact('node', 'user', 'projects'));
    }
}
