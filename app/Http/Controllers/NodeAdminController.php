<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNodeAdminAdminRequest;
use App\NodeAdmin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNodeAdminRequest;
use App\Http\Requests\UpdateNodeAdminRequest;
use App\User;
use Exception;

class NodeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NodeAdmin::with('user', 'node')->get();
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
    public function store(StoreNodeAdminAdminRequest $request)
    {
        $nodeAdmin = new User();
        $nodeAdmin->name               = $request->get('name');
        $nodeAdmin->email              = $request->get('email');
        $nodeAdmin->password           = bcrypt($request->get('document_number'));
        $nodeAdmin->document_type      = $request->get('document_type');
        $nodeAdmin->document_number    = $request->get('document_number');
        $nodeAdmin->cellphone_number   = $request->get('cellphone_number');
        $nodeAdmin->status             = $request->get('status');
        $nodeAdmin->interests          = $request->get('interests');
        $nodeAdmin->is_enabled         = $request->get('is_enabled');
        $nodeAdmin->role()->associate($request->get('role_id'));
        $nodeAdmin->save();

        $nodeAdmin->isNodeAdmin()->create([
            'id' => $nodeAdmin->id,
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
     * @param  \App\NodeAdmin  $nodeAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(NodeAdmin $nodeAdmin)
    {
        return response()->json($nodeAdmin->with('user', 'node')->where('node_admins.id', $nodeAdmin->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NodeAdmin  $nodeAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(NodeAdmin $nodeAdmin)
    {
        return response()->json($nodeAdmin->with('user', 'node')->where('node_admins.id', $nodeAdmin->id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NodeAdmin  $nodeAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNodeAdminRequest $request, NodeAdmin $nodeAdmin)
    {
        $nodeAdmin->name               = $request->get('name');
        $nodeAdmin->email              = $request->get('email');
        $nodeAdmin->password           = bcrypt($request->get('document_number'));
        $nodeAdmin->document_type      = $request->get('document_type');
        $nodeAdmin->document_number    = $request->get('document_number');
        $nodeAdmin->cellphone_number   = $request->get('cellphone_number');
        $nodeAdmin->status             = $request->get('status');
        $nodeAdmin->interests          = $request->get('interests');
        $nodeAdmin->is_enabled         = $request->get('is_enabled');
        $nodeAdmin->role()->associate($request->get('role_id'));
        $nodeAdmin->save();

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
     * @param  \App\NodeAdmin  $nodeAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(NodeAdmin $nodeAdmin)
    {
        try
        {
            if($nodeAdmin->user->delete()){
                return 'Eliminado';
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return 'Error 23000';
            }
        }
    }
}
