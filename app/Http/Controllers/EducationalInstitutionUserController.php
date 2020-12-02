<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Node;
use App\Models\EducationalInstitution;
use App\Models\User;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class EducationalInstitutionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Node $node, EducationalInstitution $educationalInstitution)
    {
        $users = $educationalInstitution->members()->orderBy('name')->get();
        
        return view('EducationalInstitutionUsers.index', compact('node', 'educationalInstitution', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Node $node, EducationalInstitution $educationalInstitution)
    {
        $roles = Role::orderBy('name')->get();

        return view('EducationalInstitutionUsers.create', compact('node', 'educationalInstitution', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, Node $node, EducationalInstitution $educationalInstitution)
    {
        $user = new User();
        $user->name               = $request->get('name');
        $user->email              = $request->get('email');
        $user->password           = bcrypt($request->get('password'));
        $user->document_type      = $request->get('document_type');
        $user->document_number    = $request->get('document_number');
        $user->cellphone_number   = $request->get('cellphone_number');
        $user->interests          = $request->get('interests');
        $user->is_enabled         = $request->get('is_enabled');
        $user->assignRole($request->get('role_id'));
        
        if($user->save()){
            $educationalInstitution->members()->attach($user);
            $message = 'Your store processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.users.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node, EducationalInstitution $educationalInstitution, User $user)
    {
        return view('EducationalInstitutionUsers.show', compact('node', 'educationalInstitution', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node, EducationalInstitution $educationalInstitution, User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('EducationalInstitutionUsers.edit', compact('node', 'educationalInstitution', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, Node $node, EducationalInstitution $educationalInstitution, User $user)
    {
        $user->name               = $request->get('name');
        $user->email              = $request->get('email');
        $user->password           = bcrypt($request->get('password'));
        $user->document_type      = $request->get('document_type');
        $user->document_number    = $request->get('document_number');
        $user->cellphone_number   = $request->get('cellphone_number');
        $user->interests          = $request->get('interests');
        $user->is_enabled         = $request->get('is_enabled');

        if($user->save()){
            $user->syncRoles($request->get('role_id'));
            $message = 'Your update processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.users.index', [$node, $educationalInstitution])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node, EducationalInstitution $educationalInstitution, User $user)
    {
        if($user->delete()){
            $message = 'Your delete processed correctly';
        }

        return redirect()->route('nodes.educational-institutions.users.index', [$node, $educationalInstitution])->with('status', $message);
    }
}
