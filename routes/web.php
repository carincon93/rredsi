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
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BusinessIdeasController;
use App\Http\Livewire\ModelForm;
use App\Http\Controllers\ObservatoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchProvidersController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ShowExperiencesController;

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
    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard');

    // ? ruta para acceder al dashboard u observatorio del usuario tipo empresa //
    Route::get('/dashboard-company', [AppController::class, 'companyDashboard'])->name('dashboard-company');

    // ? ruta para acceder al observatorio //
    Route::get('/business-observatory', [AppController::class, 'businessObservatory'])->name('business-observatory');
    // ? se manda aparte de el resource para evitar problemas en envio de datos//
    // Route::get('/notifications', [NotificationController::class, 'getAllNotifications'])->name('notifications');
    
    // ? ruta para acceder al observatorio //
    Route::post('/result-observatory', [ObservatoryController::class, 'result'])->name('result-observatory');
    
    // ? ruta para ver cada notificacion especifica //
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('notifications.show');

    // ? ruta para ver cada solicitud de participacion expecifica para aceptar o denegar participacion en proyecto //
    Route::get('/request/{id}', [NotificationController::class, 'showRequest'])->name('requests.show');

    // ? ruta para envio de notificacion de registrar en el evento anual//
    Route::post('nodes/{node}/annual-node-event/{annualNodeEventID}', [AnnualNodeEventController::class, 'registerAnnualNodeEvents'])->name('annualNodeEvent.registerAnnualNodeEvents');
    // ? ruta para ver evento anual y su crud//
    Route::get('/nodes/{node}/explorer/annual-node-event', [NodeEventController::class, 'showRREDSIEventRegisterForm'])->name('nodes.explorer.events.showRREDSIEventRegisterForm');
    // ? ruta para ver los eventos y su crud//
    Route::get('/nodes/{node}/explorer/events/{event}', [AppController::class, 'showEvent'])->name('nodes.explorer.showEvent');
    // ? ruta envio registro de un proyecto a un evento //
    Route::post('/nodes/{node}/explorer/events/{event}', [NodeEventController::class, 'sendProjectToEvent'])->name('nodes.explorer.sendProjectToEvent');
    // ? explorador de roles //
    Route::get('/nodes/{node}/explorer/roles/{academicProgram}', [AppController::class, 'searchRoles'])->name('nodes.explorer.searchRoles');
    Route::get('/nodes/{node}/explorer/roles/show-role/{user}', [AppController::class, 'showUser'])->name('nodes.explorer.searchRoles.showUser');

    // ? ruta para ver los proyectos activos y aplicar a ellos//
    Route::get('/nodes/{node}/explorer/educational-environments', [AppController::class, 'searcheducationalEnvironments'])->name('nodes.explorer.searchEducationalEnvironments');
    Route::get('/nodes/{node}/explorer/educational-environments/{educationalEnvironment}', [AppController::class, 'showEducationalEnvironment'])->name('nodes.explorer.searchEducationalEnvironments.showEducationalEnvironment');

    // ? ruta para ver los proyectos activos y aplicar a ellos//
    Route::get('/nodes/{node}/explorer/educational-tools', [AppController::class, 'searchEducationalTools'])->name('nodes.explorer.searchEducationalTools');
    Route::get('/nodes/{node}/explorer/educational-tools/{educationalTool}', [AppController::class, 'showEducationalTool'])->name('nodes.explorer.searchEducationalTools.showEducationalTool');

    // ? ruta para ver los proyectos activos y aplicar a ellos//
    Route::get('/nodes/{node}/explorer/projects', [AppController::class, 'searchProjects'])->name('nodes.explorer.searchProjects');
    Route::get('/nodes/{node}/explorer/projects/{project}', [AppController::class, 'showProject'])->name('nodes.explorer.searchProjects.showProject');
    // ? ruta para informacion de nodo //
    Route::get('/nodes/{node}/explorer/node-info', [AppController::class, 'nodeInfo'])->name('nodes.explorer.nodeInfo');
    // ? ruta notificacion para aplicar colaborar en un proyecto //
    Route::post('/nodes/{node}/explorer/projects/{user}', [NotificationController::class, 'sendRoleNotification'])->name('nodes.explorer.sendRoleNotification');

    Route::put('company/{business}', [CompanyProfileController::class, 'update'])->name('company.update');

    // ? ruta para envio de notificacion de participacion en proyecto //
    Route::post('/notifications/send-to-participate', [NotificationController::class, 'sendToParticipate'])->name('notifications.sendToParticipate');
    // ? ruta para envio de notificacion de participacion de proyecto en un evento//
    Route::post('/notifications/send-project-to-event', [NotificationController::class, 'sendProjectToEvent'])->name('notifications.sendProjectToEvent');
    // ? ruta para envio de notificacion de participacion aceptar o denegar estudiante en proyecto //
    Route::post('/notifications/to-accept-student', [NotificationController::class, 'acceptStudentInProject'])->name('notifications.acceptStudentInProject');
    // ? ruta para envio de interes de proyecto //
    Route::post('/notifications/interes/{id}', [NotificationController::class, 'interes'])->name('notifications.interes');
    // ? ruta para envio de notificaciones sobre la generación de una idea empresarial //
    Route::post('/notifications/new-business-idea/{id}', [NotificationController::class, 'newBusinessIdea'])->name('notifications.new-business-idea');
    // ? ruta para cambiar a leida notificaicon de correo//
    Route::get('/all-notifications/{id}', [NotificationController::class, 'indexResponseSend'])->name('notifications.indexResponseSend');
    // ? ruta de dashboard de instituciones educativas//
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}', [EducationalInstitutionController::class, 'dashboard'])->name('nodes.educational-institutions.dashboard');
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/bi', [EducationalInstitutionController::class, 'bi'])->name('nodes.educational-institutions.dashboard.bi');
    // ? ruta de facultades  de instituciones educativas//
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/faculties/{faculty}', [EducationalInstitutionFacultyController::class, 'dashboard'])->name('nodes.educational-institutions.faculties.dashboard');

    // ? ruta para ver los proyectos de cada estudiante //
    Route::get('/nodes/{node}/educational-institutions/{educational_institution}/faculties/{faculty}/research-groups/{research_group}/research-teams/{research_team}/my-projects',[ProjectController::class, 'myProjects'])->name('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects');

    Route::get('/legal-information/{slug}', [LegalInformationController::class, 'showLegalInformation'])->name('showLegalInformation');

    // ? rutas de solicitudes de participacion en projectos para el delegado de institucion//
    Route::get('/request-project-participation', [NotificationController::class, 'indexAdminInstitution'])->name('notifications.indexAdminInstitution');
    // ? rutas de solicitudes de participacion de cada estudiante//
    Route::get('/request-student', [NotificationController::class, 'indexRequestStudent'])->name('notifications.indexRequestStudent');

    // ? rutas de notificaciones //
    Route::resource('/notifications', NotificationController::class, [
        'names' => [
            'index'                           => 'notifications.index',
            'destroy'                         => 'notifications.destroy',
        ]
    ]);
    // ? rutas de eventos anuales index y actualizacion de estado aceptado rechazado//
    Route::resource('/annual-node-event', AnnualNodeEventController::class,[
        'names'=>[
            'index'   => 'annualNodeEvent.index',
            'show'    => 'annualNodeEvent.show',
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


    // ? ruta para acceder a mis productos y servicios //  
    Route::resource('/products', ProductController::class,[
        'names'=>[
            'edit'   => 'products.edit',
            'show'   => 'products.show',
            'destroy'   => 'products.destroy',
            'index'  => 'products.index',
            'store'  => 'products.store'

        ]
    ]);

    // ? ruta para acceder a mis productos y servicios //  
    Route::resource('/searchproviders', SearchProvidersController::class,[
        'names'=>[
            'show'   => 'searchproviders.show',
            'index'  => 'searchproviders.index',
        ]
    ]);

    // ? ruta para acceder a mis experiencias//  
    Route::resource('/experiences', ExperienceController::class,[
        'names'=>[
            'edit'   => 'experiences.edit',
            'show'   => 'experiences.show',
            'destroy'   => 'experiences.destroy',
            'index'  => 'experiences.index',
            'store'  => 'experiences.store',
        ]
    ]);

    // ? ruta para acceder a buscador de experiencias //  
    Route::resource('/showexperiences', ShowExperiencesController::class,[
        'names'=>[
            'show'   => 'showexperiences.show',
            'index'  => 'showexperiences.index',
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
        // ? rutas para el observatorio de proyectos//
        'observatories'                     => ObservatoryController::class,
        // ? ruta para el perfil empresarial //
        'company-profile'                 => CompanyProfileController::class,
        // ? ruta para acceder a las ideas empresariales //
        //'business-ideas'                    => BusinessIdeasController::class,

    ]);

    // ? rutas para acceder a las ideas empresariales //
    Route::resource('business-ideas', BusinessIdeasController::class, [
        'names'=>[
            'index'   => 'business-ideas.index',
            'show'    => 'business-ideas.show',
            'edit'    => 'business-ideas.edit',
            'update'  => 'business-ideas.update',
            'create'  => 'business-ideas.create',
            'store'   => 'business-ideas.store',
            ]
        ]);

    // ? ruta para guardar una nueva idea empresarial de la empresa logueada//
    // Route::post('business-ideas/store', [BusinessIdeasController::class, 'store'])->name('business-ideas.store');


});
