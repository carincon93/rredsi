<?php

namespace App\Http\Controllers;

use App\Http\Requests\NodeRequest;
use App\Models\Node;
use App\User;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = Node::orderBy('state')->paginate(50);
        return view('Nodes.index', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Nodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NodeRequest $request)
    {
        $node           = new Node();
        $node->state    = $request->get('state');
        $node->administrator()->associate($request->get('administrator_id'));

        if($node->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        return view('Nodes.show', compact('node'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        return view('Nodes.edit', compact('node'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(NodeRequest $request, Node $node)
    {
        $node->state    = $request->get('state');
        $node->administrator()->associate($request->get('administrator_id'));

        if($node->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        if($node->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.index')->with('status', $message);
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
