<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;

use Illuminate\Http\Request;

class EducationalInstitutionFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution)
    {
        // $this->authorize('viewAny',[EducationalInstitutionFaculty::class, $educationalInstitution]);

        $educationalInstitutionFaculties = $educationalInstitution->educationalInstitutionFaculties()->orderBy('name')->get();

        return view('EducationalInstitutionFaculties.index', compact('node', 'educationalInstitution', 'educationalInstitutionFaculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('create',[ EducationalInstitutionFaculty::class, $educationalInstitution]);

        return view('EducationalInstitutionFaculties.create', compact('node', 'educationalInstitution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('create', [EducationalInstitutionFaculty::class, $educationalInstitution]);

        $faculty = new EducationalInstitutionFaculty();
        $faculty->name          = $request->get('name');
        $faculty->email         = $request->get('email');
        $faculty->phone_number  = $request->get('phone_number');
        $faculty->ext           = $request->get('ext');
        $faculty->educationalInstitution()->associate($educationalInstitution);

        if ($faculty->save()) {
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EducationalInstitutionFaculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('view', [EducationalInstitutionFaculty::class, $educationalInstitution]);

        return view('EducationalInstitutionFaculties.show', compact('node', 'educationalInstitution', 'faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EducationalInstitutionFaculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('update',[EducationalInstitutionFaculty::class, $educationalInstitution]);

        return view('EducationalInstitutionFaculties.edit', compact('node', 'educationalInstitution', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducationalInstitutionFaculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('update', [EducationalInstitutionFaculty::class, $educationalInstitution]);

        $faculty->name          = $request->get('name');
        $faculty->email         = $request->get('email');
        $faculty->phone_number  = $request->get('phone_number');
        $faculty->ext           = $request->get('ext');
        $faculty->educationalInstitution()->associate($educationalInstitution);

        if ($faculty->save()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducationalInstitutionFaculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        $this->authorize('delete',[EducationalInstitutionFaculty::class, $educationalInstitution]);

        if ($faculty->delete()) {
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Display a dashboard of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Node $node, EducationalInstitution $educationalInstitution, EducationalInstitutionFaculty $faculty)
    {
        return view('EducationalInstitutionFaculties.dashboard', compact('node', 'educationalInstitution', 'faculty'));
    }
}
