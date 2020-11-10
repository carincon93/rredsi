<?php

namespace App\Http\Controllers;

use App\EducationalEnvironment;
use Illuminate\Http\Request;
use App\Http\Requests\EducationalEnvironmentRequest;
use Exception;

class EducationalEnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EducationalEnvironment::with('educationalInstitution')->get();
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
    public function store(EducationalEnvironmentRequest $request)
    {
        $educationalEnvironment = new EducationalEnvironment();
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        $educationalEnvironment->is_enabled     = $request->get('is_enabled');
        $educationalEnvironment->is_available   = $request->get('is_available');
        $educationalEnvironment->educationalInstitution()->associate($request->get('educational_institution_id'));
        $educationalEnvironment->save();

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
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalEnvironment $educationalEnvironment)
    {
        $educationalEnvironment->educationalInstitution;
        return response()->json($educationalEnvironment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalEnvironment $educationalEnvironment)
    {
        return response()->json($educationalEnvironment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalEnvironmentRequest $request, EducationalEnvironment $educationalEnvironment)
    {
        $educationalEnvironment->name           = $request->get('name');
        $educationalEnvironment->type           = $request->get('type');
        $educationalEnvironment->capacity_aprox = $request->get('capacity_aprox');
        $educationalEnvironment->description    = $request->get('description');
        $educationalEnvironment->is_enabled     = $request->get('is_enabled');
        $educationalEnvironment->is_available   = $request->get('is_available');
        $educationalEnvironment->educationalInstitution()->associate($request->get('educational_institution_id'));
        $educationalEnvironment->save();

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
     * @param  \App\EducationalEnvironment  $educationalEnvironment
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalEnvironment $educationalEnvironment)
    {
        try
        {
            if($educationalEnvironment->delete()){
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

    public function getByEducationalInstitution(Request $request, $id)
    {
        return EducationalEnvironment::with('educationalInstitution')->where('educational_institution_id', '=', $id)->get();
    }
}
