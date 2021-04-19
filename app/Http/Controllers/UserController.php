<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\EducationalInstitutionFaculty;

use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->authorize('create-user', [User::class]);

        $roles = Role::orderBy('name')->get();

        return view('Users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create-user', [User::class]);

        $user = new User();
        $user->name               = $request->get('name');
        $user->email              = $request->get('email');
        $user->password           = bcrypt("rredsi".$request->get('document_number')."*");
        $user->document_type      = $request->get('document_type');
        $user->document_number    = $request->get('document_number');
        $user->cellphone_number   = $request->get('cellphone_number');
        $user->interests          = $request->get('interests');
        $user->is_enabled         = $request->get('is_enabled');

        if ($user->save() ) {
            $user->syncRoles($request->get('role_id'));
            $user->educationalInstitutionFaculties()->attach($request->get('educational_institutions_faculties_id'),['is_principal'=>true]);

            // ? Send notification student create researchTeam
            if($user->hasRole(4)){
                // ? si el rol es estudiante le notificamos al coordinador de la institucion el nuevo estudiante
                $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();
                $educationalInstitution = $faculty->educationalInstitution;
                $adminInstitution = $educationalInstitution->administrator;

                $type = "Estudiante";
                Notification::send($adminInstitution, new InformationNotification($user,$type));
            }
        }else{
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
        $this->authorize('view-user', [User::class]);

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
        $this->authorize('update-user', [User::class]);

        $roles = Role::orderBy('name')->get();

        return view('Users.edit', compact('user','roles'));
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

        $this->authorize('update-user', [User::class]);

        $user->name               = $request->get('name');
        $user->email              = $request->get('email');
        $user->password           = bcrypt("rredsi".$request->get('document_number')."*");
        $user->document_type      = $request->get('document_type');
        $user->document_number    = $request->get('document_number');
        $user->cellphone_number   = $request->get('cellphone_number');
        $user->interests          = $request->get('interests');
        $user->is_enabled         = $request->get('is_enabled');

        if($user->save()){
            $user->syncRoles($request->get('role_id'));
            $message = 'Your update processed correctly';
        }

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
        $this->authorize('delete-user', [User::class]);

        $user->tokens->each->delete();

        $user->is_enabled = false;

        $user->save();

        // $user->update(['is_enabled', 0]);

        return redirect()->route('users.index')->with('status', __('The user has been deactivated correctly'));

    }
}
