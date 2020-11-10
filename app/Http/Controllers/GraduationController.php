<?php

namespace App\Http\Controllers;

use App\Graduation;
use Illuminate\Http\Request;
use App\Http\Requests\GraduationRequest;

class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Graduation::with('user')->get();
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
    public function store(GraduationRequest $request)
    {
        $graduation = new Graduation();
        $graduation->is_graduated   = $request->get('is_graduated');
        $graduation->year           = $request->get('year');
        $graduation->academicProgram()->associate($request->get('academic_program_id'));
        $graduation->user()->associate($request->get('user_id'));
        $graduation->save();

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
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function show(Graduation $graduation)
    {
        return response()->json($graduation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduation $graduation)
    {
        return response()->json($graduation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function update(GraduationRequest $request, Graduation $graduation)
    {
        $graduation->is_graduated   = $request->get('is_graduated');
        $graduation->year           = $request->get('year');
        $graduation->academicProgram()->associate($request->get('academic_program_id'));
        $graduation->user()->associate($request->get('user_id'));
        $graduation->save();

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
     * @param  \App\Graduation  $Graduation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduation $graduation)
    {
        try
        {
            $graduation = Graduation::find($graduation);
            if($graduation->delete()){
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
