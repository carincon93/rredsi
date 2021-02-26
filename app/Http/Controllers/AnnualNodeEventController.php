<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\NodeEvent;
use App\Models\Project;


use App\Models\AnnualNodeEvent;
use App\Http\Requests\AnnualNodeEventRequest;
use Exception;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;


use Illuminate\Http\Request;

class AnnualNodeEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', [AnnualNodeEvent::class]);

        $user = auth()->user();
        $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

        if($faculty){
            $node = $faculty->educationalInstitution->node;
        }

        // $nodeEvents = $node->nodeEvents->where('is_annual_event',1)->first();
        $annualNodeEvent = NodeEvent::where('is_annual_event',1)->first();

        $projects = $annualNodeEvent->nodeEvent->event->projects;
        $event = $annualNodeEvent->nodeEvent->event;

        // return NodeEvent::where('is_annual_event',1)->first() ;

        return view('AnnualNodeEvents.index', compact('node', 'projects','event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node)
    {
        // $this->authorize('create', [NodeEvent::class , $node]);

        // $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        // return view('AnnualNodeEvents.create', compact('node'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnualNodeEventRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        foreach ($project->events as $event ) {

            $dateEvent = strtotime($event->start_date);
            $yearEvent = date("Y", $dateEvent);

            if($yearEvent == date('Y') ){
                if($event->nodeEvent()->where('is_annual_event',1)){
                    $nodeEvent = $event->nodeEvent;
                }
            }

        }

        $annualNodeEvent = $nodeEvent->annualNodeEvent()->where('project_id',$project->id)->first();

         foreach ($project->authors as $author ) {

            if($author->id == $annualNodeEvent->first_speaker_id ){
                $first_speaker = $author;
            }

            if($author->id == $annualNodeEvent->second_speaker_id ){
                $second_speaker = $author;
            }

        }


        // return $project->knowledgeSubareaDisciplines()->first()->knowledgeSubarea()->first()->knowledgeArea;

        return view('AnnualNodeEvents.show', compact('project','annualNodeEvent','first_speaker','second_speaker'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(AnnualNodeEvent $annualNodeEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnnualNodeEvent $annualNodeEvent)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnualNodeEvent $annualNodeEvent)
    {
        //
    }


    public function registerAnnualNodeEvents(AnnualNodeEventRequest $request, Node $node)
    {
        try {

            $annualNodeEvent = new AnnualNodeEvent();
            $annualNodeEvent->presentation_type      = $request->get('presentation_type');
            $annualNodeEvent->project_status         = $request->get('project_status');
            $annualNodeEvent->project_id             = $request->get('project_id');
            $annualNodeEvent->first_speaker_id       = $request->get('first_speaker_id');
            $annualNodeEvent->second_speaker_id      = $request->get('second_speaker_id');

            if ($request->hasFile('endorsement_letter')) {
                $file       = $request->file('endorsement_letter');
                $extension  = $file->extension();
                $d = rand(1,5000);
                $fileName   = "$d-RREDSI-annual-events-endorsement_letter.$extension";
                Storage::putFileAs(
                    'public/annual-events', $file, $fileName
                );

                $annualNodeEvent->endorsement_letter  = "annual-events/$fileName";

            }

            if ($request->hasFile('project_article')) {
                $file       = $request->file('project_article');
                $extension  = $file->extension();
                $d = rand(1,5000);
                $fileName   = "$d-RREDSI-annual-events-project_article.$extension";

                Storage::putFileAs(
                    'public/annual-events', $file, $fileName
                );

                $annualNodeEvent->project_article  = "annual-events/$fileName";
            }

            $annualNodeEvent->nodeEvent()->associate($request->get('event_id'));

            if($annualNodeEvent->save()){
                $project      = Project::findOrFail($request->get('project_id'));
                $project->events()->attach($request->get('event_id'));
                $message = 'El registro a el evento fue correcto';

                // project authors
                $authors =  $project->authors;
                $event = $project->events->find($request->get('event_id'));

                // admin institution notification
                $user = auth()->user();
                $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

                if($faculty){
                    $educationalInstitution = $faculty->educationalInstitution;
                    $adminInstitution = $educationalInstitution->administrator;
                }

                $type =[
                    "type" => "registrar un proyecto a el evento anual",
                    "name_event" => $event->name
                ];

                #Send authors notification
                Notification::send($authors, new InformationNotification($project,$type));
                #Send admin institution notification
                Notification::send($adminInstitution, new InformationNotification($project, $type));
            }else{
                $message = 'Hubo un problema en el registro del proyecto';
            }

            return redirect()->route('nodes.explorer.roles', [$node])->with('status', $message);


        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ]);
        }

    }

}
