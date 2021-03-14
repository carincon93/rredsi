<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return redirect()->route('login');
})->name('/');


Route::middleware(['auth'])->group(function () {

    // ? ruta que define el explorador de la plataforma
    // * inicio ruta
    Route::get('/nodes/{node}/explorer', [AppController::class, 'welcome'])->name('nodes.explorer');
    Route::get('/nodes/{node}/explorer/roles', [AppController::class, 'roles'])->name('nodes.explorer.roles');
    Route::get('/nodes/{node}/explorer/events', [AppController::class, 'events'])->name('nodes.explorer.events');
    // * fin ruta

    // ? ruta para la dashboard o panel de coordinador de nodo //
    Route::get('/nodes/{node}/dashboard', [AppController::class, 'dashboard'])->name('nodes.dashboard');

    // ? ruta para ver cada notificacion expecifica para aceptar o denegar participacion en proyecto //
    // ? se manda aparte de el resource para evitar problemas en envio de datos//
    // Route::get('/notifications', [NotificationController::class, 'getAllNotifications'])->name('notifications');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    // ? ruta para ver evento anual y su crud//
    Route::get('/nodes/{node}/explorer/node-events/rredsi-event', [NodeEventController::class, 'rredsiEventRegister'])->name('nodes.explorer.events.rredsiEventRegister');
    // ? ruta para ver los eventos y su crud//
    Route::get('/nodes/{node}/explorer/events/{event}', [AppController::class, 'showEvent'])->name('nodes.explorer.showEvent');
    // ? ruta envio registro de un proyecto a un evento //
    Route::post('/nodes/{node}/explorer/events/{event}', [NodeEventController::class, 'sendProjectToEvent'])->name('nodes.explorer.sendProjectToEvent');
    // ? explorador de roles //
    Route::get('/nodes/{node}/explorer/roles/{academicProgram}', [AppController::class, 'searchRoles'])->name('nodes.explorer.searchRoles');
    Route::get('/nodes/{node}/explorer/roles/show-user/{user}', [AppController::class, 'showUser'])->name('nodes.explorer.searchRoles.showUser');
    // ? ruta para ver los proyectos activos y aplicar a ellos//
    Route::get('/nodes/{node}/explorer/projects', [AppController::class, 'searchProjects'])->name('nodes.explorer.searchProjects');
    Route::get('/nodes/{node}/explorer/projects/{project}', [AppController::class, 'showProject'])->name('nodes.explorer.searchProjects.showProject');
    // ? ruta para informacion de nodo //
    Route::get('/nodes/{node}/explorer/node-info', [AppController::class, 'nodeInfo'])->name('nodes.explorer.nodeInfo');
    // ? ruta notificacion para aplicar colaborar en un proyecto //
    Route::get('/nodes/{node}/explorer/projects/{user}', [NotificationController::class, 'sendRoleNotification'])->name('nodes.explorer.sendRoleNotification');
    // ? ruta para envio de notificacion de participacion en proyecto //
    Route::post('/notifications/send-to-participate', [NotificationController::class, 'sendToParticipate'])->name('notifications.sendToParticipate');
    // ? ruta para envio de notificacion de participacion de proyecto en un evento//
    Route::post('/notifications/send-project-to-event', [NotificationController::class, 'sendProjectToEvent'])->name('notifications.sendProjectToEvent');
    // ? ruta para envio de notificacion de participacion aceptar o denegar estudiante en proyecto //
    Route::post('/notifications/to-accept-student', [NotificationController::class, 'acceptStudent'])->name('notifications.acceptStudent');
    // ? ruta para envio de notificacion de registrar en el evento anual//
    Route::post('/annual-node-events/register-annual-node-events/{node}',[AnnualNodeEventController::class, 'registerAnnualNodeEvents'])->name('annualNodeEvent.registerAnnualNodeEvents');
    // ? ruta para cambiar a leida notificaicon de correo//
    Route::get('/all-notifications/{id}', [NotificationController::class, 'indexResponseSend'])->name('notifications.indexResponseSend');
    // ? ruta para ver cada proyecto registrado en evento anual y denegar o aceptar parcipacion//
    Route::get('/annual-node-event/{project}', [AnnualNodeEventController::class, 'show'])->name('annualNodeEvent.show');
    // ? ruta de dashboard de instituciones educativas//
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}', [EducationalInstitutionController::class, 'dashboard'])->name('nodes.educational-institutions.dashboard');
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/bi', [EducationalInstitutionController::class, 'bi'])->name('nodes.educational-institutions.dashboard.bi');
    // ? ruta de facultades  de instituciones educativas//
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/faculties/{faculty}', [EducationalInstitutionFacultyController::class, 'dashboard'])->name('nodes.educational-institutions.faculties.dashboard');

    // ? ruta para ver los proyectos de cada estudiante //
    Route::get('/nodes/{node}/educational-institutions/{educational_institution}/faculties/{faculty}/research-groups/{research_group}/research-teams/{research_team}/my-projects',[ProjectController::class, 'myProjects'])->name('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects');

    Route::get('/privacy-policy', [LegalInformationController::class, 'showPrivacyPolicy'])->name('showPrivacyPolicy');
    Route::get('/terms-and-conditions', [LegalInformationController::class, 'showTermsConditions'])->name('showTermsConditions');

    // ? rutas de notificaciones //
    Route::resource('/notifications', NotificationController::class, [
        'names' => [
            'index'           => 'notifications.index',
            'destroy'         => 'notifications.destroy'
        ]
    ]);
    // ? rutas de eventos anuales index y actualizacion de estado aceptado rechazado//
    Route::resource('/annual-node-event', AnnualNodeEventController::class,[
        'names'=>[
            'index'   => 'annualNodeEvent.index',
            'update'  => 'annualNodeEvent.update'
        ]
    ]);

    // ? rutas de user graduations//
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

    // ? rutas de user academic works//
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


    // ! rutas resources de acceso rapido a tablas//
    Route::resources([
        // ? rutas  de usuarios de sistema//
        'users'                                                                                             => UserController::class,
        // ? rutas de nodos de sistema //
        'nodes'                                                                                             => NodeController::class,
        // ? rutas de eventos de nodo//
        'nodes.events'                                                                                      => NodeEventController::class,
        // ? rutas de instituciones educativas de un nodo//
        'nodes.educational-institutions'                                                                    => EducationalInstitutionController::class,
        // ? rutas de eventos de instituciones educativas//
        'nodes.educational-institutions.events'                                                             => EducationalInstitutionEventController::class,
        // ? rutas de facultades de instituciones educativas//
        'nodes.educational-institutions.faculties'                                                          => EducationalInstitutionFacultyController::class,
        // ? rutas programas academicos de cada facultad//
        'nodes.educational-institutions.faculties.academic-programs'                                        => AcademicProgramController::class,
        // ? rutas de grupos de investigacion de cada facultad//
        'nodes.educational-institutions.faculties.research-groups'                                          => ResearchGroupController::class,
        // ? rutas de lineas de investigacion de cada facultad//
        'nodes.educational-institutions.faculties.research-groups.research-lines'                           => ResearchLineController::class,
        // ? rutas de semilleros de investigacion de cada facultad//
        'nodes.educational-institutions.faculties.research-groups.research-teams'                           => ResearchTeamController::class,
        // ? rutas de ambientes de formacion de cada facultad//
        'nodes.educational-institutions.faculties.educational-environments'                                 => EducationalEnvironmentController::class,
        // ? rutas de herramientas educativas de cada ambiente de formación //
        'nodes.educational-institutions.faculties.educational-environments.educational-tools'               => EducationalToolController::class,
        // ? rutas proyectos de cada grupo de investigación//
        'nodes.educational-institutions.faculties.research-groups.research-teams.projects'                  => ProjectController::class,
        // ? rutas de productos de investifacion de cada proyecto//
        'nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs' => ResearchOutputController::class,
        // ? rutas de usuarios pertenecientes a cada facultad//
        'nodes.educational-institutions.faculties.users'                                                    => EducationalInstitutionUserController::class,

        // ? rutas de areas de conocimiento//
        'knowledge-areas'                   => KnowledgeAreaController::class,
        // ? rutas de sub-areas de conocimiento//
        'knowledge-subareas'                => KnowledgeSubareaController::class,
        // ? rutas de disciplinas de sub-areas de conocimiento//
        'knowledge-subarea-disciplines'     => KnowledgeSubareaDisciplineController::class,
        // ? rutas de los roles de sistema//
        'roles'                             => RoleController::class,
        // ? rutas de la información legal de la plataforma//
        'legal-informations'                => LegalInformationController::class,
    ]);
});
