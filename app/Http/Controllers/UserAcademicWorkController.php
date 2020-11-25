<?php

namespace App\Http\Controllers;

use App\Models\UserAcademicWork;
use App\Models\KnowledgeArea;
use App\Models\UserGraduation;
use App\Models\ResearchGroup;
use Illuminate\Http\Request;

class UserAcademicWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAcademicWorks = UserAcademicWork::orderBy('title')->paginate(50);
        return view('AcademicWorks.index', compact('academicWorks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $knowledgeAreas = KnowledgeArea::orderBy('name')->paginate(50);
        $graduations    = UserGraduation::orderBy('user_id')->paginate(50);
        $researchGroups = ResearchGroup::orderBy('name')->paginate(50);
        return view('AcademicWorks.create', compact('knowledgeAreas','graduations','researchGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userAcademicWork = new UserAcademicWork();
        $userAcademicWork->title                    = $request->get('title');
        $userAcademicWork->type                     = $request->get('type');
        $userAcademicWork->authors                  = $request->get('authors');
        $userAcademicWork->grade                    = $request->get('grade');
        $userAcademicWork->mentors                  = $request->get('mentors');
        $userAcademicWork->researchGroup()->associate($request->get('research_group_id'));
        $userAcademicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $userAcademicWork->graduation()->associate($request->get('graduation_id'));

        if($userAcademicWork->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('academic-works.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function show(UserAcademicWork $userAcademicWork)
    {
        return view('AcademicWorks.show', compact('academicWork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAcademicWork $userAcademicWork)
    {
        return view('AcademicWorks.edit', compact('academicWork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAcademicWork $userAcademicWork)
    {
        $userAcademicWork->title                    = $request->get('title');
        $userAcademicWork->type                     = $request->get('type');
        $userAcademicWork->authors                  = $request->get('authors');
        $userAcademicWork->grade                    = $request->get('grade');
        $userAcademicWork->mentors                  = $request->get('mentors');
        $userAcademicWork->researchGroup()->associate($request->get('research_group_id'));
        $userAcademicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $userAcademicWork->graduation()->associate($request->get('graduation_id'));

        if($userAcademicWork->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('academic-works.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAcademicWork $userAcademicWork)
    {
        if($userAcademicWork->delete()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('academic-works.index')->with('status', $message);
    }
}
