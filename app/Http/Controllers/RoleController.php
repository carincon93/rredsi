<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', [Role::class]);

        $roles = Role::orderBy('name')->get();

        return view('Roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [Role::class]);

        $permissions = Permission::orderBy('model')->get();

        return view('Roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Role::class]);

        $role = new Role();
        $role->name        = $request->name;
        $role->description = $request->description;
        $role->guard_name  = 'web';
        if($role->save()) {
            $role->syncPermissions($request->permissions);
            $message = 'Your store processed correctly';
        }

        return redirect()->route('roles.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view', [Role::class]);

        return view('Roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', [Role::class]);

        $permissions = Permission::orderBy('id')->get();

        return view('Roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', [Role::class]);

        $role->name         = $request->name;
        $role->description  = $request->description;
        $role->guard_name   = 'web';
        if($role->save()) {
            $role->syncPermissions($request->permissions);
            $message = 'Your update processed correctly';
        }

        return redirect()->route('roles.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete',[Role::class]);

        if($role->id >= 1 && $role->id <= 4 ){
            $message = 'Este rol es predefinido no es posible borrarlo';
        }else{
             if($role->delete()) {
                $message = 'Your delete processed correctly';
             }
        }


        return redirect()->route('roles.index')->with('status', $message);
    }
}
