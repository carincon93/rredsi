<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('name')->get();
        return view('Students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
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

        if($student->save()) {
            $message = 'Your store processed correctly';
        }

        $student->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);
        $student->academicPrograms()->attach($request->get('academic_program_id'));

        $student->isStudent()->create([
            'id'            => $student->id,
            'cvlac'         => $request->get('cvlac'),
            'is_accepted'   => $request->get('is_accepted'),
        ]);

        return redirect()->route('students.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('Students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('Students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
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

        if($student->user->save()) {
            $message = 'Your update processed correctly';
        }

        $student->isStudent()->update([
            'cvlac'         => $request->get('cvlac'),
            'is_accepted'   => $request->get('is_accepted'),
        ]);

        $student->user->researchTeams()->wherePivot('user_id', '=', $student->id)->detach();
        $student->user->researchTeams()->attach($request->get('research_team_id'), ['is_external' => false]);
        $student->user->academicPrograms()->wherePivot('user_id', '=', $student->id)->detach();
        $student->user->academicPrograms()->attach($request->get('academic_program_id'));

        return redirect()->route('students.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if($student->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('students.index')->with('status', $message);
    }
}
