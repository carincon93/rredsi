<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use App\Models\Businessideas;
use App\Http\Requests\BusinessIdeasRequest;



class BusinessIdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user                = auth()->user();
        $business_ideas      = BusinessIdeas::Paginate(10);
        $business            = Business::All();

        return view('BusinessIdeas.index', compact('business_ideas','business'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user                = auth()->user();
        $user->business()->get();
        $user_business = $user->business()->first();

        return view('BusinessIdeas.create', compact('user_business'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessIdeasRequest $request, BusinessIdeas $business_idea)
    {

        $business_idea->business_id     = $user_business->id;
        $business_idea->name            = $request->get('name');
        $business_idea->description     = $request->get('description');
        $business_idea->type            = $request->get('type');
        $business_idea->have_tools      = null;
        $business_idea->how_many_tools  = null;
        $business_idea->have_money      = null;
        $business_idea->how_many_money  = null;
        $business_idea->condition       = $request->get('condition');

        $business_idea->save();

        return redirect()->route('business-ideas.index')
        ->with('success', 'La idea fue creada correctamente');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user           = auth()->user();
        $user->business()->get();
        $user_business  = $user->business()->first();
        $idea           = BusinessIdeas::find($id);

        return view('BusinessIdeas.edit', compact('idea','user_business'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user           = auth()->user();
        $user->business()->get();
        $user_business  = $user->business()->first();
        $idea           = BusinessIdeas::find($id);

        return view('BusinessIdeas.show', compact('idea','user_business'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idea = BusinessIdeas::find($id)->delete();

        return redirect()->route('business-ideas.index')
            ->with('success', 'La idea fue eliminada correctamente');
    }



}
