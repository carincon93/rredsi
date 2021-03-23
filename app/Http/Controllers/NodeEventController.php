<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;

use App\Models\Node;
use App\Models\Event;
use App\Models\AnnualNodeEvent;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\EventRequest;
use App\Http\Requests\AnnualNodeEventRequest;
use App\Models\Project;


use App\Models\NodeEvent;
use Illuminate\Http\Request;

class NodeEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node)
    {
        $this->authorize('viewAny', [NodeEvent::class , $node]);

        $events = $node->nodeEvents()->where('node_id', $node->id)->with('event')->get();

        return view('NodeEvents.index', compact('node', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node)
    {
        $this->authorize('create', [NodeEvent::class , $node]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('NodeEvents.create', compact('node', 'knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, Node $node)
    {
        $this->authorize('create', [NodeEvent::class , $node]);

        $event = new Event();
        $event->name            = $request->get('name');
        $event->location        = $request->get('location');
        $event->description     = $request->get('description');
        $event->start_date      = $request->get('start_date');
        $event->end_date        = $request->get('end_date');
        $event->register_link   = $request->get('register_link');
        $event->info_link       = $request->get('info_link');
        $event->save();

         // ? asociamos el evento al node event
        $event->nodeEvent()->create([
            'id'        => $event->id,
            'node_id'   => $node->id,
            'is_annual_event' => $request->get('is_annual_event')
        ]);

        if($event->save()){
            $event->knowledgeSubareaDisciplines()->attach($request->get('knowledge_subarea_discipline_id'));
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.events.index', [$node])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, Event $event)
    {
        $this->authorize('view', [NodeEvent::class , $node]);

        return view('NodeEvents.show', compact('node', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, Event $event)
    {
        $this->authorize('update', [NodeEvent::class , $node]);

        $knowledgeAreas = KnowledgeArea::orderBy('name')->get();

        return view('NodeEvents.edit', compact('node', 'event', 'knowledgeAreas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Node $node, Event $event)
    {
        $this->authorize('update',[ NodeEvent::class , $node]);

        $event->name            = $request->get('name');
        $event->location        = $request->get('location');
        $event->description     = $request->get('description');
        $event->start_date      = $request->get('start_date');
        $event->end_date        = $request->get('end_date');
        $event->register_link   = $request->get('register_link');
        $event->info_link       = $request->get('info_link');
        $event->is_annual_event = $request->get('is_annual_event');

         // ? asociamos el evento al node event
        $event->nodeEvent()->update([
            'node_id'   => $node->id
        ]);

        if($event->save()){
            $event->knowledgeSubareaDisciplines()->sync($request->get('knowledge_subarea_discipline_id'));
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.events.index', [$node])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, Event $event)
    {
        $this->authorize('delete', [NodeEvent::class , $node]);

        if($event->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.events.index', [$node])->with('status', $message);
    }

    /**
     * Send project to event.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function sendProjectToEvent(Request $request, Node $node, Event $event)
    {
        $event->projects()->sync($request->get('project_id'));

        return redirect()->away($event->register_link);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ? index para registro de evento
    public function showRREDSIEventRegisterForm(Node $node)
    {
        $knowledgeAreas     = KnowledgeArea::orderBy('name')->get();
        $events             = Event::orderBy('name')->get();
        $annualNodeEvent    = $node->nodeEvents()->where('node_events.is_annual_event', 1)->with('event')->first();

        if (date('Y', strtotime($annualNodeEvent->event->end_date)) == date('Y') ) {
            $projects                                           = auth()->user()->projects;
            $researchTeams                                      = auth()->user()->researchTeams;
            $educationalInstitutionFacultiesacademicPrograms    = auth()->user()->educationalInstitutionFaculties()->with('academicPrograms')->get();
            $educationalInstitutionFacultiesUsers               = auth()->user()->educationalInstitutionFaculties()->with('members')->get()->pluck('members')->flatten();

            return view('Explorer.Events.rredsi-event-register', compact('node', 'knowledgeAreas', 'educationalInstitutionFacultiesUsers', 'projects', 'researchTeams', 'educationalInstitutionFacultiesacademicPrograms', 'annualNodeEvent'));
        } else {
            return redirect()->back()->with('status', 'Aún no hay un evento de RREDSI disponible');
        }
    }
}

