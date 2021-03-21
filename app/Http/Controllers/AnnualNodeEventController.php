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

        $user       = auth()->user();
        $faculty    = $user->educationalInstitutionFaculties()->where('is_principal', 1)->first();

        if($faculty){
            $node = $faculty->educationalInstitution->node;
        }

        // ? traemos el evento anual del nodo
        $nodeEvents         = $node->nodeEvents->where('is_annual_event', 1)->first();
        $annualNodeEvent    = $nodeEvents->annualNodeEvent;
        $projects           = $annualNodeEvent->nodeEvent->event->projects;
        $event              = $annualNodeEvent->nodeEvent->event;

        return view('AnnualNodeEvents.index', compact('node', 'projects', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnualNodeEventRequest $request)
    {
        //
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
                if($event->nodeEvent()->where('is_annual_event', 1)){
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

        return view('AnnualNodeEvents.show', compact('project', 'annualNodeEvent', 'first_speaker', 'second_speaker'));
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
        $project        = Project::findOrFail($request->get('project_id'));
        $researchGroup  = $project->researchTeams()->where('is_principal', 1)->first()->researchGroup;
        $faculty        = $researchGroup->educationalInstitutionFaculty;

        if($faculty){
            $educationalInstitution = $faculty->educationalInstitution;
            $adminInstitution =  $educationalInstitution->administrator;
        }

        $first_speaker  = User::findOrFail($annualNodeEvent->first_speaker_id);
        $second_speaker = User::findOrFail($annualNodeEvent->second_speaker_id);

        // ? condicion en caso de rechazar la participacion del proyecto
        if(!is_null($request->get('comments'))){
            // ? tipo de notificacion
            $type = [
                "case" => "Respuesta a su solicitud de participación en el evento anual",
                "comments" => $request->get('comments'),
                "annualEventResponse" => "Rechazado(a)"
            ];

            $annualNodeEvent->update([ 'status' => $request->get('status') , 'comments' => $request->get('comments')]);

            // notification admin institution
            Notification::send($adminInstitution, new InformationNotification($project, $type));
            // notification first_speaker
            Notification::send($first_speaker, new InformationNotification($project, $type));
            // notification second_speaker
            Notification::send($second_speaker, new InformationNotification($project, $type));

            $message = 'Solicitud denegada con exito';
            return redirect()->route('annualNodeEvent.index')->with('status', $message);

        }else{
            // ? condición en caso de aceptar la participacion del proyecto
            $type = [
                "case"                  => "Respuesta a su solicitud de participación en el evento anual",
                "comments"              => "de cumplir los requerimientos",
                "annualEventResponse"   => "Aceptado(a)"
            ];

            $annualNodeEvent->update([ 'status' => $request->get('status')]);

            // notification admin institution
            Notification::send($adminInstitution, new InformationNotification($project,$type));
            // notification first_speaker
            Notification::send($first_speaker, new InformationNotification($project,$type));
            // notification second_speaker
            Notification::send($second_speaker, new InformationNotification($project,$type));

            $message = 'Solicitud aceptada con éxito';
            return redirect()->route('annualNodeEvent.index')->with('status', $message);

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


    public function registerAnnualNodeEvents(AnnualNodeEventRequest $request, Node $node, $annualNodeEventID)
    {
        $nodeEvent  = NodeEvent::where('id', $annualNodeEventID)->where('is_annual_event', 1)->firstOrFail();

        $nodeEventYear  = date('Y', strtotime($nodeEvent->event()->first()->end_date));

        // ? condicion para validar si el proyecto a registrar ya se encuentra registrado
        if($nodeEvent->annualNodeEvent()->where('project_id', $request->get('project_id'))->first()){
            return redirect()->back()->with('status', 'Este proyecto ya se encuentra registrado en este evento');
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
            $projectId  = $request->get('project_id');
            $fileName   = "$projectId-RREDSI-$nodeEventYear-carta-aval.$extension";
            Storage::putFileAs(
                'public/annual-events', $file, $fileName
            );

            $annualNodeEvent->endorsement_letter  = "annual-events/$fileName";

        }
        // ? guardamos los archivos
        if ($request->hasFile('project_article')) {
            $file       = $request->file('project_article');
            $extension  = $file->extension();
            $projectId  = $request->get('project_id');
            $fileName   = "$projectId-RREDSI-$nodeEventYear-articulo.$extension";

            Storage::putFileAs(
                'public/annual-events', $file, $fileName
            );

            $annualNodeEvent->project_article  = "annual-events/$fileName";
        }

        // ? asociamos el registro al evento de nodo
        $annualNodeEvent->nodeEvent()->associate($annualNodeEventID);

        if($annualNodeEvent->save()){
            // ? asociamos el projecto al evento
            $project = Project::findOrFail($request->get('project_id'));
            $project->events()->attach($annualNodeEventID);
            $message = 'El registro al evento fue exitoso';

            // project authors
            $authors =  $project->authors;

            // admin institution notification
            $user       = auth()->user();
            $faculty    = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

            if($faculty){
                $educationalInstitution = $faculty->educationalInstitution;
                $adminInstitution = $educationalInstitution->administrator;
            }

            // ? tipo de notificación
            $type =[
                "type"          => "registrar un proyecto al evento anual",
                "name_event"    => $nodeEvent->event()->first()->name
            ];

            #Send authors notification
            Notification::send($authors, new InformationNotification($project,$type));
            #Send admin institution notification
            Notification::send($adminInstitution, new InformationNotification($project, $type));
        } else {
            $message = 'Hubo un problema en el registro del proyecto';
        }

        return redirect()->back()->with('status', $message);
    }
}
