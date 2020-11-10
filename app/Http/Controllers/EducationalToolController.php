<?php

namespace App\Http\Controllers;

use App\EducationalTool;
use Illuminate\Http\Request;
use App\Http\Requests\EducationalToolRequest;
use Exception;

class EducationalToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EducationalTool::with('educationalEnvironment', 'educationalEnvironment.educationalInstitution', 'educationalToolLoan')->get();
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
    public function store(EducationalToolRequest $request)
    {
        $educationalTool = new EducationalTool();
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
        $educationalTool->is_available  = $request->get('is_available');
        $educationalTool->is_enabled    = $request->get('is_enabled');
        $educationalTool->educationalEnvironment()->associate($request->get('educational_environment_id'));
        $educationalTool->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your update processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalTool $educationalTool)
    {
        $educationalTool->educationalEnvironment;
        $educationalTool->educationalEnvironment->educationalInstitution;
        return response()->json($educationalTool);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalTool $educationalTool)
    {
        return response()->json($educationalTool);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalToolRequest $request, EducationalTool $educationalTool)
    {
        $educationalTool->name          = $request->get('name');
        $educationalTool->description   = $request->get('description');
        $educationalTool->qty           = $request->get('qty');
        $educationalTool->is_available  = $request->get('is_available');
        $educationalTool->is_enabled    = $request->get('is_enabled');
        $educationalTool->educationalEnvironment()->associate($request->get('educational_environment_id'));
        $educationalTool->save();

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
     * @param  \App\EducationalTool  $educationalTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalTool $educationalTool)
    {
        try
        {
            if($educationalTool->delete()){
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
