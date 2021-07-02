<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use App\Models\BusinessIdeas;
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
        $user       = auth()->user();
        $business   = $user->business()->first();;
        $ideas      = BusinessIdeas::where('business_id','=',$business->id)->Paginate(10);


        return view('BusinessIdeas.index', compact('ideas','business'));
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
    public function store(BusinessIdeasRequest $request)
    {

        $user          = auth()->user();
        $user_business = $user->business()->first();

        $business_idea = New BusinessIdeas;

        $business_idea->business_id     = $user_business->id;
        $business_idea->name            = $request->get('name');
        $business_idea->description     = $request->get('description');
        $business_idea->type            = $request->get('type');
        $business_idea->have_tools      = $request->get('have_tools');
        $business_idea->how_many_tools  = $request->get('tools');
        $business_idea->have_money      = $request->get('have_money');
        $business_idea->how_many_money  = $request->get('money');
        $business_idea->condition       = $request->get('condition');


        if($business_idea->save()){
            return redirect()->route('business-ideas.index')->with('success', 'La idea fue creada correctamente');
        } else{
            return redirect()->route('business-ideas.create')->with('success', 'Hubo un error al momento de crear la idea');
        }

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


    public function update(BusinessIdeasRequest $request, BusinessIdeas $idea)
    {
        $user          = auth()->user();
        $user_business = $user->business()->first();

        $idea->business_id     = $user_business->id;
        $idea->name            = $request->get('name');
        $idea->description     = $request->get('description');
        $idea->type            = $request->get('type');
        $idea->have_tools      = $request->get('have_tools');
        $idea->how_many_tools  = $request->get('tools');
        $idea->have_money      = $request->get('have_money');
        $idea->how_many_money  = $request->get('money');
        $idea->condition       = $request->get('condition');


        if($idea->save()){

        return redirect()->back()->with('status', 'Actualización exitosa');
        }else{
            return redirect()->back()->with('status','Hubo probema al guardar');
        }
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
