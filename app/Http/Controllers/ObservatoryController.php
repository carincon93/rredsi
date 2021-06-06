<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Node;



class observatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(20);
        
        return view('observatories.index')->with('projects', $projects);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('observatories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new project;
        $project->titleOfTheProject= $request->title_of_the_project;
        $project->projectSummary= $request->project_summary;
        $project->educationalInstitutionsAssociatedWithTheProject= $request->educational_institutions_associated_with_the_project;
        $project->listOfResearchersAssociatedWithTheProject= $request->list_of_researchers_associated_with_the_project;

         if($project->save()) {
          return redirect('projects')->with('message', 'El proyecto: '.$project->title_of_the_project.' fue adicionado con exito');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $buscar
     * @return \Illuminate\Http\Response
     */
    public function result(Node $node, Request $request)
    {   
        $search= $request->get('txt-search');
        if (!is_null($search)) {                  
            //Paginar por grupos de N projectos
            $projects = Project::where('title','ILIKE','%'.$search.'%')->orwhere('abstract','ILIKE','%'.$search.'%')->orwhere('keywords','ILIKE','%'.$search.'%')->orderby('title')->get();
        }else{
            $projects =[];
        }
        return view('observatories.result', compact('node', 'projects','search'));
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $researchGroup  = $project->researchTeams()->where('is_principal', 1)->first()->researchGroup;
        $faculty        = $researchGroup->educationalInstitutionFaculty;

        if($faculty){
            $educationalInstitution = $faculty->educationalInstitution;
            $adminInstitution =  $educationalInstitution->administrator;
        }
        return view('observatories.show', compact('project', 'educationalInstitution'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        //dd($user);
        return view('observatories.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $project = Project::find($id);
        $project->title_of_the_project= $request->title_of_the_project;
        $project->project_summary= $request->project_summary;
        $project->educational_institutions_associated_with_the_project= $request->educational_institutions_associated_with_the_project;
        $project->list_of_researchers_associated_with_the_project= $request->list_of_researchers_associated_with_the_project;

         if($article->save()) {
          return redirect('projects')->with('message', 'El proyecto: '.$project->title_of_the_project.' fue modificado con exito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if($project->delete()){
            return redirect('projects')->with('message', 'El proyecto: '.$project->title_of_the_project. 'fue eliminado con exito!');
        }
    }

    public function alert($id) 
    {
        \Alert::info('this is a test message')
            ->details('this is awesome')
            ->button('Go back to the home page', '#', 'primary');
        return view('test');
    }    
}