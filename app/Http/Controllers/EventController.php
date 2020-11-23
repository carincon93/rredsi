<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('name')->paginate(50);
        return view('Events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->name        = $request->get('name');
        $event->location    = $request->get('location');
        $event->description = $request->get('description');
        $event->start_date  = $request->get('start_date');
        $event->end_date    = $request->get('end_date');
        $event->link        = $request->get('link');
        $event->save();

        if($event->type == 'Institución educativa') {
            $event->educationalInstitutionEvent()->create([
                'id'                            => $event->id,
                'educational_institution_id'    => $request->get('educational_institution_id')
            ]);
        } elseif($event->type == 'Nodo') {
            $event->nodeEvent()->create([
                'id'        => $event->id,
                'node_id'   => $request->get('node_id')
            ]);
        }

        if($event->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('events.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('Events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('Events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->name        = $request->get('name');
        $event->location    = $request->get('location');
        $event->description = $request->get('description');
        $event->start_date  = $request->get('start_date');
        $event->end_date    = $request->get('end_date');
        $event->link        = $request->get('link');

        if($event->type == 'Institución educativa') {
            $event->educationalInstitutionEvent()->update([
                'educational_institution_id'    => $request->get('educational_institution_id')
            ]);
        } elseif($event->type == 'Nodo') {
            $event->nodeEvent()->update([
                'node_id'   => $request->get('node_id')
            ]);
        }

        if($event->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('events.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if($event->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('events.index')->with('status', $message);
    }
}
