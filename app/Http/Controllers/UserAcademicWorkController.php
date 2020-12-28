<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;
use App\Models\UserGraduation;
use App\Models\UserAcademicWork;

use App\Http\Requests\UserAcademicWorkRequest;
use Illuminate\Http\Request;

class UserAcademicWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserGraduation $userGraduation)
    {
        $this->authorize('viewAny', UserAcademicWork::class, $userGraduation);

        $userAcademicWork = $userGraduation->userAcademicWork()->orderBy('title')->first();

        return view('AcademicWorks.index', compact('userGraduation', 'userAcademicWork'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserGraduation $userGraduation)
    {
        $this->authorize('create', UserAcademicWork::class, $userGraduation);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('AcademicWorks.create', compact('userGraduation', 'knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAcademicWorkRequest $request, UserGraduation $userGraduation)
    {
        $this->authorize('create', UserAcademicWork::class, $userGraduation);

        $userAcademicWork = new UserAcademicWork();
        $userAcademicWork->title                    = $request->get('title');
        $userAcademicWork->type                     = $request->get('type');
        $userAcademicWork->authors                  = $request->get('authors');
        $userAcademicWork->grade                    = $request->get('grade');
        $userAcademicWork->mentors                  = $request->get('mentors');
        $userAcademicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $userAcademicWork->userGraduation()->associate($userGraduation);

        if($userAcademicWork->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.user-academic-works.index', [$userGraduation])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function show(UserGraduation $userGraduation, UserAcademicWork $userAcademicWork)
    {
        $this->authorize('view', UserAcademicWork::class, $userGraduation, $userAcademicWork);

        return view('AcademicWorks.show', compact('userGraduation', 'userAcademicWork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGraduation $userGraduation, UserAcademicWork $userAcademicWork)
    {
        $this->authorize('update', UserAcademicWork::class, $userGraduation, $userAcademicWork);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('AcademicWorks.edit', compact('userGraduation', 'userAcademicWork', 'knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function update(UserAcademicWorkRequest $request, UserGraduation $userGraduation, UserAcademicWork $userAcademicWork)
    {
        $this->authorize('update', UserAcademicWork::class, $userGraduation, $userAcademicWork);

        $userAcademicWork->title                    = $request->get('title');
        $userAcademicWork->type                     = $request->get('type');
        $userAcademicWork->authors                  = $request->get('authors');
        $userAcademicWork->grade                    = $request->get('grade');
        $userAcademicWork->mentors                  = $request->get('mentors');
        $userAcademicWork->knowledgeArea()->associate($request->get('knowledge_area_id'));
        $userAcademicWork->userGraduation()->associate($userGraduation);

        if($userAcademicWork->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.user-academic-works.index', [$userGraduation])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAcademicWork  $userAcademicWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGraduation $userGraduation, UserAcademicWork $userAcademicWork)
    {
        $this->authorize('delete', UserAcademicWork::class, $userGraduation, $userAcademicWork);

        if($userAcademicWork->delete()) {
            $message = 'Your update processed correctly';
        }

        return redirect()->route('user.profile.user-graduations.user-academic-works.index', [$userGraduation])->with('status', $message);
    }
}
