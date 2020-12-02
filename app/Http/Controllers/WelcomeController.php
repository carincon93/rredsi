<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\KnowledgeArea;
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

        $node->shuffleProjects = $node->shuffleProjects();
        $node->shuffleEducationalInstitutionEvents = $node->shuffleEducationalInstitutionEvents();

        return view('welcome', compact('node', 'knowledgeAreas'));
    }
}
