<?php

namespace App\Http\Controllers;

use App\AcademicWork;
use Illuminate\Http\Request;


class AcademicWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academicWorks = AcademicWork::orderBy('title')->paginate(50);
        return view('AcademicWorks.index', compact('academicWorks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AcademicWorks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $academicWork = new AcademicWork();
        $academicWork->title                    = $request->get('title');
        $academicWork->type                     = $request->get('type');
        $academicWork->authors                  = $request->get('authors');
        $academicWork->grade                    = $request->get('grade');
        $academicWork->mentors                  = $request->get('mentors');
        $academicWork->researchGroup()->associate($request->get('research_group_id'));
        $academicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $academicWork->graduation()->associate($request->get('graduation_id'));
        
        if($academicWork->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('academic-works.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicWork $academicWork)
    {
        return view('AcademicWorks.show', compact('academicWork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicWork $academicWork)
    {
        return view('AcademicWorks.edit', compact('academicWork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicWork $academicWork)
    {
        $academicWork->title                    = $request->get('title');
        $academicWork->type                     = $request->get('type');
        $academicWork->authors                  = $request->get('authors');
        $academicWork->grade                    = $request->get('grade');
        $academicWork->mentors                  = $request->get('mentors');
        $academicWork->researchGroup()->associate($request->get('research_group_id'));
        $academicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $academicWork->graduation()->associate($request->get('graduation_id'));
        
        if($academicWork->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('academic-works.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicWork $academicWork)
    {
        if($academicWork->delete()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('academic-works.index')->with('status', $message);
    }
}
