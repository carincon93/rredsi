<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\StoreEducationalInstitutionAdminRequest;
use App\Http\Requests\UpdateEducationalInstitutionAdminRequest;

use App\EducationalInstitutionAdmin;
use App\User;

class EducationalInstitutionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return EducationalInstitutionAdmin::with('user', 'educationalInstitution', 'node')->get();
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
    public function store(StoreEducationalInstitutionAdminRequest $request)
    {
        $educationalInstitutionAdmin = new User();
        $educationalInstitutionAdmin->name               = $request->get('name');
        $educationalInstitutionAdmin->email              = $request->get('email');
        $educationalInstitutionAdmin->password           = bcrypt($request->get('document_number'));
        $educationalInstitutionAdmin->document_type      = $request->get('document_type');
        $educationalInstitutionAdmin->document_number    = $request->get('document_number');
        $educationalInstitutionAdmin->cellphone_number   = $request->get('cellphone_number');
        $educationalInstitutionAdmin->status             = $request->get('status');
        $educationalInstitutionAdmin->interests          = $request->get('interests');
        $educationalInstitutionAdmin->is_enabled         = $request->get('is_enabled');
        $educationalInstitutionAdmin->role()->associate($request->get('role_id'));
        $educationalInstitutionAdmin->save();

        $educationalInstitutionAdmin->isEducationalInstitutionAdmin()->create([
            'id' => $educationalInstitutionAdmin->id,
            'node_id' => $request->get('node_id'),
        ]);

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
     * @param  \App\EducationalInstitutionAdmin  $educationalInstitutionAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalInstitutionAdmin $educationalInstitutionAdmin)
    {
        return response()->json($educationalInstitutionAdmin->with('educationalInstitution', 'node', 'user')->where('id', $educationalInstitutionAdmin->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationalInstitutionAdmin  $educationalInstitutionAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalInstitutionAdmin $educationalInstitutionAdmin)
    {
        return response()->json($educationalInstitutionAdmin->with('user')->where('educational_institution_admins.id', $educationalInstitutionAdmin->id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationalInstitutionAdmin  $educationalInstitutionAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEducationalInstitutionAdminRequest $request, EducationalInstitutionAdmin $educationalInstitutionAdmin)
    {
        $educationalInstitutionAdmin->user->name               = $request->get('name');
        $educationalInstitutionAdmin->user->email              = $request->get('email');
        $educationalInstitutionAdmin->user->password           = bcrypt($request->get('document_number'));
        $educationalInstitutionAdmin->user->document_type      = $request->get('document_type');
        $educationalInstitutionAdmin->user->document_number    = $request->get('document_number');
        $educationalInstitutionAdmin->user->cellphone_number   = $request->get('cellphone_number');
        $educationalInstitutionAdmin->user->status             = $request->get('status');
        $educationalInstitutionAdmin->user->interests          = $request->get('interests');
        $educationalInstitutionAdmin->user->is_enabled         = $request->get('is_enabled');
        $educationalInstitutionAdmin->user->role()->associate($request->get('role_id'));
        $educationalInstitutionAdmin->user->save();

        $educationalInstitutionAdmin->node_id = $request->get('node_id');
        $educationalInstitutionAdmin->save();

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
     * @param  \App\EducationalInstitutionAdmin  $educationalInstitutionAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalInstitutionAdmin $educationalInstitutionAdmin)
    {
        $educationalInstitutionAdmin->user->delete();
    }
}
