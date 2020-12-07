<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\Event;

use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;

class EducationalInstitutionEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution)
    {
        $events = $educationalInstitution->educationalInstitutionEvents()->where('educational_institution_id', $educationalInstitution->id)->with('event')->get();

        return view('EducationalInstitutionEvents.index', compact('node', 'educationalInstitution', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution)
    {
        return view('EducationalInstitutionEvents.create', compact('node', 'educationalInstitution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, Node $node, EducationalInstitution $educationalInstitution)
    {
        $event = new Event();
        $event->name        = $request->get('name');
        $event->location    = $request->get('location');
        $event->description = $request->get('description');
        $event->start_date  = $request->get('start_date');
        $event->end_date    = $request->get('end_date');
        $event->link        = $request->get('link');
        $event->save();

        $event->educationalInstitutionEvent()->create([
            'id'                            => $event->id,
            'educational_institution_id'    => $educationalInstitution->id
        ]);

        if($event->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.events.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, Event $event)
    {
        return view('EducationalInstitutionEvents.show', compact('node', 'educationalInstitution', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, Event $event)
    {
        return view('EducationalInstitutionEvents.edit', compact('node', 'educationalInstitution', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Node $node, EducationalInstitution $educationalInstitution, Event $event)
    {
        $event->name        = $request->get('name');
        $event->location    = $request->get('location');
        $event->description = $request->get('description');
        $event->start_date  = $request->get('start_date');
        $event->end_date    = $request->get('end_date');
        $event->link        = $request->get('link');

        $event->educationalInstitutionEvent()->update([
            'educational_institution_id' => $educationalInstitution->id
        ]);

        if($event->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.events.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, Event $event)
    {
        if($event->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.events.index', [$node, $educationalInstitution])->with('status', $message);
    }
}
