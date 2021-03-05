<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\ResearchGroup;

use App\Http\Requests\EducationalInstitutionRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;
use Exception;
use Illuminate\Support\Facades\Storage;

class EducationalInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node)
    {
        $this->authorize('viewAny', [EducationalInstitution::class, $node]);

        $educationalInstitutions = $node->educationalInstitutions()->orderBy('name')->get();

        return view('EducationalInstitutions.index', compact('node', 'educationalInstitutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node)
    {
        $this->authorize('create',[EducationalInstitution::class, $node]);

        $cities = json_decode(Storage::get('public/json/caldas_cities.json'), true);
        $admins = User::whereHas('roles', function($q){ $q->where('id', 3); })->get();

        return view('EducationalInstitutions.create', compact('node', 'cities', 'admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalInstitutionRequest $request, Node $node)
    {
        $this->authorize('create',[EducationalInstitution::class, $node]);

        $educationalInstitution = new EducationalInstitution();
        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->node()->associate($node);

        if($educationalInstitution->save()){

            $educationalInstitution->administrator()->associate($request->get('administrator_id'));

            $intitutions = $node->educationalInstitutions;
            $users = [];

            foreach ($intitutions as $intitution) {
                if(!is_null($intitution->administrator) ){
                    array_push($users,$intitution->administrator);
                }
            }

            $type = "Institución educativa";
            Notification::send($users, new InformationNotification($educationalInstitution,$type));

            $message = 'Your store processed correctly';
        }


        return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('view', [EducationalInstitution::class, $node]);

        return view('EducationalInstitutions.show', compact('node', 'educationalInstitution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('update', [EducationalInstitution::class, $node]);

        $cities = json_decode(Storage::get('public/json/caldas_cities.json'), true);
        $admins = User::whereHas('roles', function($q){ $q->where('id', 3); })->get();

        return view('EducationalInstitutions.edit', compact('node', 'educationalInstitution', 'cities', 'admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalInstitutionRequest $request, Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('update', [EducationalInstitution::class,$node]);

        $educationalInstitution->name           = $request->get('name');
        $educationalInstitution->nit            = $request->get('nit');
        $educationalInstitution->address        = $request->get('address');
        $educationalInstitution->city           = $request->get('city');
        $educationalInstitution->phone_number   = $request->get('phone_number');
        $educationalInstitution->website        = $request->get('website');
        $educationalInstitution->node()->associate($node);
        $educationalInstitution->administrator()->associate($request->get('administrator_id'));

        if($educationalInstitution->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationalInstitution  $educationalInstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution)
    {

        $this->authorize('delete', [EducationalInstitution::class, $node]);

        if(!is_null($educationalInstitution->administrator)){
            $message ="No es posible eliminar la institución educativa ya que tiene de coordinador(a) a  ".$educationalInstitution->administrator->name;
            return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);
        }

        if($educationalInstitution->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.index', [$node])->with('status', $message);



    }

    /**
     * Display a dashboard of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('isAdmin', [EducationalInstitution::class, $node , $educationalInstitution]);


        return view('EducationalInstitutions.dashboard', compact('node', 'educationalInstitution'));
    }

    /**
     * Display BI.
     *
     * @return \Illuminate\Http\Response
     */
    public function bi(Node $node, EducationalInstitution $educationalInstitution)
    {
        $this->authorize('isAdmin', [EducationalInstitution::class, $node , $educationalInstitution]);

        $educationalInstitution->projectsByKnowledgeArea        = $educationalInstitution->projectsByKnowledgeArea();
        $educationalInstitution->projectsByYear                 = $educationalInstitution->projectsByYear();
        $educationalInstitution->projectsByProjectTypes         = $educationalInstitution->projectsByProjectTypes();
        $educationalInstitution->eventsAndProjects              = $educationalInstitution->eventsAndProjects();

        return view('EducationalInstitutions.bi', compact('node', 'educationalInstitution'));
    }

}
