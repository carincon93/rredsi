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
        $this->authorize('viewAny', UserGraduation::class);

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
        $this->authorize('create', UserGraduation::class);

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
        $this->authorize('create', UserGraduation::class);

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
        $this->authorize('view', UserGraduation::class, $userGraduation);

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
        $this->authorize('update', UserGraduation::class, $userGraduation);

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
        $this->authorize('update', UserGraduation::class, $userGraduation);

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
        $this->authorize('delete', UserGraduation::class, $userGraduation);

        if($userGraduation->delete()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.index')->with('status', $message);
    }
}
