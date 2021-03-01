<?php

namespace App\Http\Controllers;

use App\Models\AnnualNodeEvent;
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
<<<<<<< Updated upstream
        //
=======
        $this->authorize('viewAny', [AnnualNodeEvent::class]);

        $user = auth()->user();
        $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

        if($faculty){
            $node = $faculty->educationalInstitution->node;
        }

        $nodeEvents = $node->nodeEvents->where('is_annual_event',1)->first();
        // $annualNodeEvent = NodeEvent::where('is_annual_event',1)->first();

        // $projects = $annualNodeEvent->nodeEvent->event->projects;
        // $event = $annualNodeEvent->nodeEvent->event;

        // return NodeEvent::where('is_annual_event',1)->first() ;

        return view('AnnualNodeEvents.index', compact('node', 'projects','event'));
>>>>>>> Stashed changes
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return \Illuminate\Http\Response
     */
    public function show(AnnualNodeEvent $annualNodeEvent)
    {
        //
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
        //
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
}
