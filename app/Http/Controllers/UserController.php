<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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

        $this->authorize('index-users', [User::class]);


        $users = User::orderBy('name', 'ASC')->paginate(100);

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
        $user->fieldName = $request->get('fieldName');
        $user->fieldName = $request->get('fieldName');
        $user->fieldName = $request->get('fieldName');

        if ( !$user->save() ) {
            return redirect()->route('users.create')->withInput()->with('status', __('An error has ocurred. Please try again later.'));
        }

        return redirect()->route('users.index')->with('status', __('The resource has been created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fieldName = $request->get('fieldName');
        $user->fieldName = $request->get('fieldName');
        $user->fieldName = $request->get('fieldName');

        if ( !$user->save() ) {
            return redirect()->route('users.index', [$user])->withInput()->with('status', __('An error has ocurred. Please try again later.'));
        }

        return redirect()->route('users.index')->with('status', __('The resource has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ( !$user->delete() ) {
            return redirect()->route('users.index', [$user])->withInput()->with('status', __('An error has ocurred. Please try again later.'));
        }

        return redirect()->route('users.index')->with('status', __('The resource has been deleted successfully.'));
    }
}
