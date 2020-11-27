<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name               = $request->get('name');
        $user->email              = $request->get('email');
        $user->password           = bcrypt($request->get('document_number'));
        $user->document_type      = $request->get('document_type');
        $user->document_number    = $request->get('document_number');
        $user->cellphone_number   = $request->get('cellphone_number');
        $user->status             = $request->get('status');
        $user->interests          = $request->get('interests');
        $user->is_enabled         = $request->get('is_enabled');
        $user->role()->associate($request->get('role_id'));

        if($user->save()){
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('Users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name               = $request->get('name');
        $user->email              = $request->get('email');
        $user->password           = bcrypt($request->get('document_number'));
        $user->document_type      = $request->get('document_type');
        $user->document_number    = $request->get('document_number');
        $user->cellphone_number   = $request->get('cellphone_number');
        $user->status             = $request->get('status');
        $user->interests          = $request->get('interests');
        $user->is_enabled         = $request->get('is_enabled');
        $user->role()->associate($request->get('role_id'));
        $user->save();

        if($user->save()){
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('users.index')->with('status', $message);
    }
}
