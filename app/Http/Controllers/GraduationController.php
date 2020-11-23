<?php

namespace App\Http\Controllers;

use App\Models\Graduation;
use App\Models\EducationalInstitution;
use App\Http\Requests\GraduationRequest;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graduations = Graduation::orderBy('is_graduated')->paginate(50);

        return view('Graduations.index', compact('graduations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educationalInstitutions = EducationalInstitution::orderBy('name')->get();

        return view('Graduations.create', compact('educationalInstitutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GraduationRequest $request)
    {
        $graduation = new Graduation();
        $graduation->is_graduated   = $request->get('is_graduated');
        $graduation->year           = $request->get('year');
        $graduation->academicProgram()->associate($request->get('academic_program_id'));
        $graduation->user()->associate(auth()->user()->id);
        
        if($graduation->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('graduations.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function show(Graduation $graduation)
    {
        return view('Graduations.show', compact('graduation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduation $graduation)
    {
        return view('Graduations.edit', compact('graduation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduation $graduation)
    {
        $graduation->is_graduated   = $request->get('is_graduated');
        $graduation->year           = $request->get('year');
        $graduation->academicProgram()->associate($request->get('academic_program_id'));
        $graduation->user()->associate($request->get('user_id'));
        
        if($graduation->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('graduations.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduation $graduation)
    {
        if($graduation->delete()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('graduations.index')->with('status', $message);
    }

    /**
     * 
     * Show the form for saving graduation info.
     *
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function showGraduationInfoRequestForm()
    {
        return view('Graduations.graduationInfoRequest');
    }
}
