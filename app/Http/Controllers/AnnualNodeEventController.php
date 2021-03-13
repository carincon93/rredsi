<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\NodeEvent;
use App\Models\Project;


use App\Models\AnnualNodeEvent;
use App\Http\Requests\AnnualNodeEventRequest;
use App\Models\Event;
use App\Models\User;
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

        // ? traemos el evento anual de el nodo
        $nodeEvents = $node->nodeEvents->where('is_annual_event',1)->first();
        $annualNodeEvent = $nodeEvents->annualNodeEvent;

        $projects = $annualNodeEvent->nodeEvent->event->projects;
        $event = $annualNodeEvent->nodeEvent->event;

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
            // ? traemos la infromacion de los dos ponentes
            if($author->id == $annualNodeEvent->first_speaker_id ){
                $first_speaker = $author;
            }

            if($author->id == $annualNodeEvent->second_speaker_id ){
                $second_speaker = $author;
            }

        }


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
        // return $annualNodeEvent;

        try {
            //code...
            $project      = Project::findOrFail($request->get('project_id'));
            $researchGroup  = $project->researchTeams()->where('is_principal',1)->first()->researchGroup;
            $faculty = $researchGroup->educationalInstitutionFaculty;

            if($faculty){
                $educationalInstitution = $faculty->educationalInstitution;
                $adminInstitution =  $educationalInstitution->administrator;
            }

            $first_speaker =  User::findOrFail($annualNodeEvent->first_speaker_id);
            $second_speaker =  User::findOrFail($annualNodeEvent->second_speaker_id);

            // ? condicion en caso de rechazar la participacion del proyecto
            if(!is_null($request->get('comments'))){
                // ? tipo de notificacion
                $type = [
                    "case" => "Respuesta a su solicitud de participación en el evento anual",
                    "comments" => $request->get('comments'),
                    "annualEventResponse" => "Rechazad@"
                ];

                $annualNodeEvent->update([ 'status' => $request->get('status') , 'comments' => $request->get('comments')]);

                // notification admin institution
                Notification::send($adminInstitution, new InformationNotification($project,$type));
                // notification first_speaker
                Notification::send($first_speaker, new InformationNotification($project,$type));
                // notification second_speaker
                Notification::send($second_speaker, new InformationNotification($project,$type));

                $message = 'Solicitud denegada con exito';
                return redirect()->route('annualNodeEvent.index')->with('status', $message);

            }else{
                // ? condicion en caso de aceptar la participacion del proyecto
                $type = [
                    "case" => "Respuesta a su solicitud de participación en el evento anual",
                    "comments" => "de cumplir los requerimientos",
                    "annualEventResponse" => "Aceptad@"
                ];

                $annualNodeEvent->update([ 'status' => $request->get('status')]);

                // notification admin institution
                Notification::send($adminInstitution, new InformationNotification($project,$type));
                // notification first_speaker
                Notification::send($first_speaker, new InformationNotification($project,$type));
                // notification second_speaker
                Notification::send($second_speaker, new InformationNotification($project,$type));

                $message = 'Solicitud aceptada con exito';
                return redirect()->route('annualNodeEvent.index')->with('status', $message);

            }




        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ]);
        }


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
            // Validamos si el proyecto ya esta registrado
            $user = auth()->user();
            $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

            if($faculty){
                $node = $faculty->educationalInstitution->node;
            }

            $nodeEvents = $node->nodeEvents->where('is_annual_event',1)->first();
            $annualNodeEventRegister = $nodeEvents->annualNodeEvent;
            $project      = Project::findOrFail($request->get('project_id'));
            $eventNew     = Event::findOrFail($request->get('event_id'));

            // ? condicion para validar si el proyecto a registrar ya se encuentra registrado
            if($annualNodeEventRegister){
                // proyectos  ya registrados en el evento
                $projectsRegister = $annualNodeEventRegister->nodeEvent->event->projects;

                foreach ($projectsRegister as $projectRegister) {

                    $eventsOld = $projectRegister->events;

                    foreach ($eventsOld as  $eventOld) {

                        if($eventOld->id == $eventNew->id){
                            if($projectRegister->id == $project->id){
                                return redirect()->route('nodes.explorer.roles', [$node])->with('status', "Este proyecto ya se encuentra registrado en este evento");
                            }
                        }

                    }

                }

            }

            // ? registramos el proyecto al evento anual
            $annualNodeEvent = new AnnualNodeEvent();
            $annualNodeEvent->presentation_type      = $request->get('presentation_type');
            $annualNodeEvent->project_status         = $request->get('project_status');
            $annualNodeEvent->project_id             = $request->get('project_id');
            $annualNodeEvent->first_speaker_id       = $request->get('first_speaker_id');
            $annualNodeEvent->second_speaker_id      = $request->get('second_speaker_id');

            // ? guardamos los archivos
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
            // ? guardamos los archivos
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

            // ? asociamos el registro al evento de nodo
            $annualNodeEvent->nodeEvent()->associate($request->get('event_id'));

            if($annualNodeEvent->save()){
                // ? asociamos el projecto al evento
                $project->events()->attach($request->get('event_id'));
                $message = 'El registro a el evento fue correcto';

                // project authors
                $authors    =  $project->authors;
                $event      = Event::findOrFail($request->get('event_id'));

                // admin institution notification
                $user = auth()->user();
                $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

                if($faculty){
                    $educationalInstitution = $faculty->educationalInstitution;
                    $adminInstitution = $educationalInstitution->administrator;
                }

                // ? tipo de notificacion
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
