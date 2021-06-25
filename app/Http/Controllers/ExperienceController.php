<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['experiences'] = DB::table('experiences')
            
            ->join('businesses', 'businesses.id', '=', 'experiences.id_business')
            ->select('experiences.*', 'businesses.name', 'businesses.cellphone_number', 'businesses.email', 'businesses.address')
            ->paginate(10);

        return view('experiences.index',$datos);
    }


    public function show($id)
    { 
        
        $experience=Experience::findOrFail($id);
        $business = Business::where('businesses.id','=', $experience->id_business)->first();
        return view('experiences.show', compact('experience','business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $business = $user->business()->first();
        return view('experiences.create',compact('business'));
    }

    public function store(ExperienceRequest $request)
    {

        $experience = new Experience();
        $experience->Title                              = $request->get('Title');
        $experience->Description                        = $request->get('Description');
        $experience->id_business                        = $request->get('id_business');

        $file = $request->get('Image');

        if ($request->hasFile('Image')){

            $file=$request->file('Image')->store('experience-images','public');
            $experience->Image = $file;
        }

        

      
        if($experience->save()){ 

            return redirect()->back()->with('mensaje','Experiencia agregada con exito'); 
        }else{

            return redirect()->back()->with('mensaje','Hubo un error al agregar la experiencia');
        }

    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $experience=Experience::findOrFail($id);
        $business = Business::where('businesses.id','=', $experience->id_business)->first();
        return view('experiences.edit', compact('experience','business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {

        $experience->Title                              = $request->get('Title');
        $experience->Description                        = $request->get('Description');


        $file = $request->get('Image');

        if ($request->hasFile('Image')){
            Storage::delete("public/$experience->Image");
            $file=$request->file('Image')->store('experience-images','public');
            $experience->Image = $file;
        }

        


        if($experience->save()){ 

            return redirect()->back()->with('mensaje','Experiencia editada con éxito'); 
        }else{

            return redirect()->back()->with('mensaje','Hubo un error al editar la experiencia');
        }

       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $experience=Experience::findOrFail($id);

        Storage::delete('public/'.$experience->Image);
        Experience::destroy($id);

       return redirect('experiences')->with('mensaje','experiencia borrada con éxito');
    }
}
