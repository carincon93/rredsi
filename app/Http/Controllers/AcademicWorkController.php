<?php

namespace App\Http\Controllers;

use App\AcademicWork;
use Illuminate\Http\Request;
use App\Http\Requests\AcademicWorkRequest;


class AcademicWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AcademicWork::with('graduations', 'graduations.user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicWorkRequest $request)
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
        $academicWork->save();

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
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicWork $academicWork)
    {
        return response()->json($academicWork);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicWork $academicWork)
    {
        return response()->json($academicWork);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicWorkRequest $request, AcademicWork $academicWork)
    {
        $academicWork->title                    = $request->get('title');
        $academicWork->type                     = $request->get('type');
        $academicWork->authors                  = $request->get('authors');
        $academicWork->grade                    = $request->get('grade');
        $academicWork->mentors                  = $request->get('mentors');
        $academicWork->researchGroup()->associate($request->get('research_group_id'));
        $academicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $academicWork->graduation()->associate($request->get('graduation_id'));
        $academicWork->save();

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
     * @param  \App\AcademicWork  $academicWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicWork $academicWork)
    {
        try
        {
            if($academicWork->delete()){
                return response()->json('Eliminado');
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return response()->json('Error 23000');
            }
        }
    }
}
