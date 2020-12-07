<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Event;

use App\Http\Requests\EventRequest;
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
        return view('NodeEvents.create', compact('node'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, Node $node)
    {
        $event = new Event();
        $event->name        = $request->get('name');
        $event->location    = $request->get('location');
        $event->description = $request->get('description');
        $event->start_date  = $request->get('start_date');
        $event->end_date    = $request->get('end_date');
        $event->link        = $request->get('link');
        $event->save();

        $event->nodeEvent()->create([
            'id'        => $event->id,
            'node_id'   => $node->id
        ]);
       
        if($event->save()){
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
        return view('NodeEvents.edit', compact('node', 'event'));
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
        $event->name        = $request->get('name');
        $event->location    = $request->get('location');
        $event->description = $request->get('description');
        $event->start_date  = $request->get('start_date');
        $event->end_date    = $request->get('end_date');
        $event->link        = $request->get('link');

        $event->nodeEvent()->update([
            'node_id'   => $node->id
        ]);

        if($event->save()){
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
        if($event->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.events.index', [$node])->with('status', $message);
    }
}