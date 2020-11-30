<?php

namespace App\Http\Controllers;

use App\Models\UserGraduation;
use App\Models\Node;

use App\Http\Requests\UserGraduationRequest;
use Illuminate\Http\Request;

class UserGraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGraduations = auth()->user()->userGraduations()->get();

        return view('Graduations.index', compact('userGraduations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nodes = Node::orderBy('state')->get();

        return view('Graduations.create', compact('nodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGraduationRequest $request)
    {
        $userGraduation = new UserGraduation();
        $userGraduation->is_graduated   = $request->get('is_graduated');
        $userGraduation->year           = $request->get('year');
        $userGraduation->academicProgram()->associate($request->get('academic_program_id'));
        $userGraduation->user()->associate(auth()->user()->id);
        
        if($userGraduation->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserGraduation  $userGraduation
     * @return \Illuminate\Http\Response
     */
    public function show(UserGraduation $userGraduation)
    {
        return view('Graduations.show', compact('userGraduation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserGraduation  $userGraduation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGraduation $userGraduation)
    {
        $nodes = Node::orderBy('state')->get();

        return view('Graduations.edit', compact('nodes', 'userGraduation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserGraduation  $userGraduation
     * @return \Illuminate\Http\Response
     */
    public function update(UserGraduationRequest $request, UserGraduation $userGraduation)
    {
        $userGraduation->is_graduated   = $request->get('is_graduated');
        $userGraduation->year           = $request->get('year');
        $userGraduation->academicProgram()->associate($request->get('academic_program_id'));
        $userGraduation->user()->associate(auth()->user()->id);

        if($userGraduation->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserGraduation  $userGraduation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGraduation $userGraduation)
    {
        if($userGraduation->delete()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.index')->with('status', $message);
    }
}
