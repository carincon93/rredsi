<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\EducationalInstitutionFacultyController;
use App\Http\Controllers\UserGraduationController;
use App\Http\Controllers\UserAcademicWorkController;
use App\Http\Controllers\EducationalEnvironmentController;
use App\Http\Controllers\EducationalInstitutionController;
use App\Http\Controllers\ResearchGroupController;
use App\Http\Controllers\EducationalToolController;
use App\Http\Controllers\EducationalInstitutionEventController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\KnowledgeAreaController;
use App\Http\Controllers\KnowledgeSubareaDisciplineController;
use App\Http\Controllers\KnowledgeSubareaController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\ResearchLineController;
use App\Http\Controllers\ResearchTeamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ResearchOutputController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EducationalInstitutionUserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NodeEventController;
use App\Http\Controllers\LegalInformationController;
use App\Http\Controllers\AnnualNodeEventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Livewire\ModelForm;
use App\Models\NodeEvent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect()->route('/', 1);
    // Quemado
});

Route::get('/nodes/{node}/explorer', [AppController::class, 'welcome'])->name('/');
Route::get('/nodes/{node}/explorer/roles', [AppController::class, 'roles'])->name('nodes.explorer.roles');
Route::get('/nodes/{node}/explorer/events', [AppController::class, 'events'])->name('nodes.explorer.events');

Route::middleware(['auth'])->group(function () {

    Route::get('/nodes/{node}/dashboard', [AppController::class, 'dashboard'])->name('nodes.dashboard');

    Route::get('/dashboard', function() {
        return redirect()->route('nodes.dashboard', 1);
        // Quemado
    });

    Route::get('/model-form', function () {
        return view('livewire.model-form');
    })->name('model-form');

    Route::get('/notifications', [NotificationController::class, 'getAllNotifications'])->name('notifications');
    Route::get('/nodes/{node}/explorer/node-events/rredsi-event', [NodeEventController::class, 'rredsiEventRegister'])->name('nodes.explorer.events.rredsiEventRegister');
    Route::get('/nodes/{node}/explorer/events/{event}', [AppController::class, 'showEvent'])->name('nodes.explorer.showEvent');
    Route::post('/nodes/{node}/explorer/events/{event}', [NodeEventController::class, 'sendProjectToEvent'])->name('nodes.explorer.sendProjectToEvent');
    Route::get('/nodes/{node}/explorer/roles/{academicProgram}', [AppController::class, 'searchRoles'])->name('nodes.explorer.searchRoles');
    Route::get('/nodes/{node}/explorer/roles/show-user/{user}', [AppController::class, 'showUser'])->name('nodes.explorer.searchRoles.showUser');
    Route::get('/nodes/{node}/explorer/projects', [AppController::class, 'searchProjects'])->name('nodes.explorer.searchProjects');
    Route::get('/nodes/{node}/explorer/projects/{project}', [AppController::class, 'showProject'])->name('nodes.explorer.searchProjects.showProject');
    Route::get('/nodes/{node}/explorer/node-info', [AppController::class, 'nodeInfo'])->name('nodes.explorer.nodeInfo');
    Route::get('/nodes/{node}/explorer/projects/{user}', [NotificationController::class, 'sendRoleNotification'])->name('nodes.explorer.sendRoleNotification');
    Route::post('/notifications/send-to-participate', [NotificationController::class, 'sendToParticipate'])->name('notifications.sendToParticipate');
    Route::post('/notifications/sendProjectToEvent', [NotificationController::class, 'sendProjectToEvent'])->name('notifications.sendProjectToEvent');
    Route::post('/notifications/acceptStudent', [NotificationController::class, 'acceptStudent'])->name('notifications.acceptStudent');
    Route::post('/annual-node-events/register-annual-node-events/{node}',[AnnualNodeEventController::class, 'registerAnnualNodeEvents'])->name('annualNodeEvent.registerAnnualNodeEvents');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::get('/notificationsIndexSend/{id}', [NotificationController::class, 'indexResponseSend'])->name('notifications.indexResponseSend');
    Route::get('/annual-node-event/{project}', [AnnualNodeEventController::class, 'show'])->name('annualNodeEvent.show');

    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}', [EducationalInstitutionController::class, 'dashboard'])->name('nodes.educational-institutions.dashboard');
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/bi', [EducationalInstitutionController::class, 'bi'])->name('nodes.educational-institutions.dashboard.bi');
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/faculties/{faculty}', [EducationalInstitutionFacultyController::class, 'dashboard'])->name('nodes.educational-institutions.faculties.dashboard');

    Route::get('/nodes/{node}/educational-institutions/{educational_institution}/faculties/{faculty}/research-groups/{research_group}/research-teams/{research_team}/my-projects',[ProjectController::class, 'myProjects'])->name('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects');

    Route::resource('/notifications', NotificationController::class, [
        'names' => [
            'index'           => 'notifications.index',
            'destroy'         => 'notifications.destroy'
        ]
    ]);

    Route::resource('/annual-node-event', AnnualNodeEventController::class,[
        'names'=>[
            'index'   => 'annualNodeEvent.index',
            'update'  => 'annualNodeEvent.update'
        ]
    ]);

    Route::resource('/user/profile/user-graduations', UserGraduationController::class, [
        'names' => [
            'index'     => 'user.profile.user-graduations.index',
            'show'      => 'user.profile.user-graduations.show',
            'create'    => 'user.profile.user-graduations.create',
            'edit'      => 'user.profile.user-graduations.edit',
            'store'     => 'user.profile.user-graduations.store',
            'update'    => 'user.profile.user-graduations.update',
            'destroy'   => 'user.profile.user-graduations.destroy',
        ]
    ]);

    Route::resource('/user/profile/user-graduations/{user_graduation}/user-academic-works', UserAcademicWorkController::class, [
        'names' => [
            'index'     => 'user.profile.user-graduations.user-academic-works.index',
            'show'      => 'user.profile.user-graduations.user-academic-works.show',
            'create'    => 'user.profile.user-graduations.user-academic-works.create',
            'edit'      => 'user.profile.user-graduations.user-academic-works.edit',
            'store'     => 'user.profile.user-graduations.user-academic-works.store',
            'update'    => 'user.profile.user-graduations.user-academic-works.update',
            'destroy'   => 'user.profile.user-graduations.user-academic-works.destroy',
        ]
    ]);

    Route::resources([
        'users'                                                                                             => UserController::class,
        'nodes'                                                                                             => NodeController::class,
        'nodes.events'                                                                                      => NodeEventController::class,
        'nodes.educational-institutions'                                                                    => EducationalInstitutionController::class,
        'nodes.educational-institutions.events'                                                             => EducationalInstitutionEventController::class,
        'nodes.educational-institutions.faculties'                                                          => EducationalInstitutionFacultyController::class,
        'nodes.educational-institutions.faculties.academic-programs'                                        => AcademicProgramController::class,
        'nodes.educational-institutions.faculties.research-groups'                                          => ResearchGroupController::class,
        'nodes.educational-institutions.faculties.research-groups.research-lines'                           => ResearchLineController::class,
        'nodes.educational-institutions.faculties.research-groups.research-teams'                           => ResearchTeamController::class,
        'nodes.educational-institutions.faculties.educational-environments'                                 => EducationalEnvironmentController::class,
        'nodes.educational-institutions.faculties.educational-environments.educational-tools'               => EducationalToolController::class,
        'nodes.educational-institutions.faculties.research-groups.research-teams.projects'                  => ProjectController::class,
        'nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs' => ResearchOutputController::class,
        'nodes.educational-institutions.faculties.users'                                                    => EducationalInstitutionUserController::class,

        'knowledge-areas'                   => KnowledgeAreaController::class,
        'knowledge-subareas'                => KnowledgeSubareaController::class,
        'knowledge-subarea-disciplines'     => KnowledgeSubareaDisciplineController::class,
        'roles'                             => RoleController::class,
        'legal-informations'                => LegalInformationController::class
    ]);
});
