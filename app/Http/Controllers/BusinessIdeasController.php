<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use App\Models\BusinessIdeas;
use App\Http\Requests\BusinessIdeasRequest;
use Illuminate\Support\Facades\Bus;
use PharIo\Manifest\Author;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;



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
        $business   = $user->business()->first();
        $ideas      = BusinessIdeas::where('business_id','=',$business->id)->Paginate(10);
        $this->authorize('viewAny',[BusinessIdeas::class, $ideas]);

        return view('BusinessIdeas.index', compact('ideas','business'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user           = auth()->user();
        $user_business  = $user->business()->first();
        $idea           = BusinessIdeas::find($id);
       
        $this->authorize('view',[BusinessIdeas::class, $idea]);

        return view('BusinessIdeas.show', compact('idea','user_business'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $user_business = $user->business()->first();
        $idea = New BusinessIdeas;
        $this->authorize('create', [BusinessIdeas::class, $idea]);

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
        $business_idea->tools           = $request->get('tools');
        $business_idea->have_money      = $request->get('have_money');
        $business_idea->money           = $request->get('money');
        $business_idea->condition       = $request->get('condition');

        $this->authorize('create', [BusinessIdeas::class, $business_idea]);

        if($business_idea->save()){
            // ? Crea un nuevo objeto de la clase Notification y ejecuta el método newBusinesIdea para crear la notificación de la idea
            $notification = New NotificationController;
            $notification->newBusinessIdea($business_idea);
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
        $user_business  = $user->business()->first();
        $idea           = BusinessIdeas::find($id);
        
        $this->authorize('update', [BusinessIdeas::class, $idea]);

        return view('BusinessIdeas.edit', compact('idea','user_business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessIdeas  $product
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessIdeasRequest $request, $id)
    {
        $idea = BusinessIdeas::find($id);

        $idea->name            = $request->get('name');
        $idea->description     = $request->get('description');
        $idea->type            = $request->get('type');
        $idea->have_tools      = $request->get('have_tools');
        $idea->tools           = $request->get('tools');
        $idea->have_money      = $request->get('have_money');
        $idea->money           = $request->get('money');
        $idea->condition       = $request->get('condition');

        $this->authorize('update', [BusinessIdeas::class, $idea]);

        if($idea->save()){
            return redirect()->route('business-ideas.index')->with('success', 'La idea fue editada correctamente');;
        }else{
            return redirect()->back()->with('status','Hubo un probema al guardar');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $business = $user->business()->first();
        $idea = BusinessIdeas::find($id);

        $this->authorize('delete', [BusinessIdeas::class, $idea]);
        $idea = BusinessIdeas::find($id)->delete();

        return redirect()->route('business-ideas.index')
            ->with('success', 'La idea fue eliminada correctamente');
    }



}
