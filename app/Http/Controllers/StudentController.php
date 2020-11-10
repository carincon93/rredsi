<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::with('user', 'isResearchTeamLeader', 'user.researchTeams')->get();
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
    public function store(StoreStudentRequest $request)
    {
        $student = new User();
        $student->name               = $request->get('name');
        $student->email              = $request->get('email');
        $student->password           = bcrypt($request->get('document_number'));
        $student->document_type      = $request->get('document_type');
        $student->document_number    = $request->get('document_number');
        $student->cellphone_number   = $request->get('cellphone_number');
        $student->status             = $request->get('status');
        $student->interests          = $request->get('interests');
        $student->is_enabled         = $request->get('is_enabled');
        $student->role()->associate($request->get('role_id'));
        
        $student->save();

        $student->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);
        $student->academicPrograms()->attach($request->get('academic_program_id'));

        $student->isStudent()->create([
            'id'            => $student->id,
            'cvlac'         => $request->get('cvlac'),
            'is_accepted'   => $request->get('is_accepted'),
        ]);

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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json($student->user()->with('researchTeams')->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return response()->json($student->user()->with('researchTeams')->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->user->name               = $request->get('name');
        $student->user->email              = $request->get('email');
        $student->user->password           = bcrypt($request->get('document_number'));
        $student->user->document_type      = $request->get('document_type');
        $student->user->document_number    = $request->get('document_number');
        $student->user->cellphone_number   = $request->get('cellphone_number');
        $student->user->status             = $request->get('status');
        $student->user->interests          = $request->get('interests');
        $student->user->is_enabled         = $request->get('is_enabled');
        $student->user->role()->associate($request->get('role_id'));
        $student->user->save();

        $student->isStudent()->update([
            'cvlac'         => $request->get('cvlac'),
            'is_accepted'   => $request->get('is_accepted'),
        ]);

        $student->user->researchTeams()->wherePivot('user_id', '=', $student->id)->detach();
        $student->user->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);
        $student->user->academicPrograms()->wherePivot('user_id', '=', $student->id)->detach();
        $student->user->academicPrograms()->attach($request->get('academic_program_id'));

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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try
        {
            if($student->user->delete()){
                return response()->json('Eliminado');
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
