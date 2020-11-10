<?php

namespace App\Http\Controllers;

use App\Node;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateNodeRequest;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Node::with('administrator.user')->get();
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
    public function store(StoreNodeRequest $request)
    {
        $node           = new Node();
        $node->state    = $request->get('state');
        $node->administrator()->associate($request->get('administrator_id'));
        $node->save();

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
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        return response()->json($node->with('administrator.user')->where('nodes.id', $node->id)->first());
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        return response()->json($node);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNodeRequest $request, Node $node)
    {
        $node->state    = $request->get('state');
        $node->administrator()->associate($request->get('administrator_id'));
        $node->save();

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
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        try
        {
            if($node->delete()){
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

    /**
     * Get educational institutions by node.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function getEducationalInstitutions(Node $node)
    {
        return $node->educationalInstitutions()->get();
    }
}
