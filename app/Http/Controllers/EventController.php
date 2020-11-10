<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::with('educationalInstitutionEvent.educationalInstitution', 'nodeEvent.node')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
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

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your store processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
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
        $event->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your update processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        try
        {
            $event = Event::find($event);
            if($event->delete()){
                return response()->json('Eliminado');
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return response()->json('Error 23000');
            }
        }
    }
}
