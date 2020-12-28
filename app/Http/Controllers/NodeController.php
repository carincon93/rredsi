<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Node;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\NodeRequest;
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
        $this->authorize('viewAny', Node::class);

        $nodes = Node::orderBy('state')->get();
        return view('Nodes.index', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Node::class);

        $users = User::orderBy('name')->get();

        return view('Nodes.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NodeRequest $request)
    {
        $this->authorize('create', Node::class);

        $node        = new Node();
        $node->state = $request->get('state');
        if ($request->hasFile('logo')) {
            $file       = $request->file('logo');
            $extension  = $file->extension();
            $fileName   = "RREDSI-$node->state-logo.$extension";
            Storage::putFileAs(
                'public/logos', $file, $fileName
            );

            $node->logo  = "logos/$fileName";
        }
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
        $this->authorize('view', Node::class, $node);

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
        $this->authorize('update', Node::class ,$node);

        $users = User::orderBy('name')->get();

        return view('Nodes.edit', compact('node', 'users'));
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
        $this->authorize('update', Node::class ,$node);

        $node->state = $request->get('state');
        if ($request->hasFile('logo')) {
            Storage::delete("public/$node->logo");
            $file       = $request->file('logo');
            $extension  = $file->extension();
            $fileName   = "RREDSI-$node->state-logo.$extension";
            Storage::putFileAs(
                'public/logos', $file, $fileName
            );

            $node->logo = "logos/$fileName";
        }
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
        $this->authorize('delete', Node::class, $node);

        if($node->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.index')->with('status', $message);
    }
}
