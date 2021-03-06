<?php

namespace App\Http\Controllers;

use App\Models\ShowExperiences;
use App\Models\Experience;
use App\Models\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowExperiencesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ShowExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        $business = $user->business()->first();
        $experience = new Experience();
        $this->authorize('viewAny',[Experience::class, $experience]);

        $datos['experiences'] = DB::table('experiences')
            ->join('businesses', 'businesses.id', '=', 'experiences.id_business')
            ->select('experiences.*', 'businesses.name', 'businesses.cellphone_number', 'businesses.email', 'businesses.address')
            ->paginate(10);

        return view('showexperiences.index',$datos);
       
    }
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShowExperiences  $ShowExperiences
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $user = auth()->user();
        $business = $user->business()->first();
        $experience=Experience::findOrFail($id);
        $this->authorize('view',[Experience::class, $experience]);
        $business = Business::where('businesses.id','=', $experience->id_business)->first();
        return view('ShowExperiences.show', compact('experience','business'));
    }

}
