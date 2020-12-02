<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\UserGraduationController;
use App\Http\Controllers\UserAcademicWorkController;
use App\Http\Controllers\EducationalEnvironmentController;
use App\Http\Controllers\EducationalInstitutionController;
use App\Http\Controllers\ResearchGroupController;
use App\Http\Controllers\EducationalToolController;
use App\Http\Controllers\EducationalInstitutionEventController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\KnowledgeAreaController;
use App\Http\Controllers\KnowledgeSubareaDisciplinesController;
use App\Http\Controllers\KnowledgeSubareaController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\ResearchLineController;
use App\Http\Controllers\ResearchTeamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ResearchOutputController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EducationalInstitutionUserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\ModelForm;

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

Route::get('/nodes/{node}/welcome', [WelcomeController::class, 'index'])->name('/');
Route::get('/', function() {
    return redirect()->route('/', 1);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/model-form', function () {
        return view('livewire.model-form');
    })->name('model-form');

    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}', [EducationalInstitutionController::class, 'dashboard'])->name('nodes.educational-institutions.dashboard');
    Route::get('/dashboard/nodes/{node}/educational-institutions/{educational_institution}/bi', [EducationalInstitutionController::class, 'bi'])->name('nodes.educational-institutions.dashboard.bi');

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
        'nodes'                                                                         => NodeController::class,
        'nodes.educational-institutions'                                                => EducationalInstitutionController::class,
        'nodes.educational-institutions.events'                                         => EducationalInstitutionEventController::class,
        'nodes.educational-institutions.academic-programs'                              => AcademicProgramController::class,
        'nodes.educational-institutions.research-groups'                                => ResearchGroupController::class,
        'nodes.educational-institutions.research-groups.research-lines'                 => ResearchLineController::class,
        'nodes.educational-institutions.research-groups.research-teams'                 => ResearchTeamController::class,
        'nodes.educational-institutions.educational-environments'                       => EducationalEnvironmentController::class,
        'nodes.educational-institutions.educational-environments.educational-tools'     => EducationalToolController::class,
        'nodes.educational-institutions.research-groups.research-teams.projects'        => ProjectController::class,
        'nodes.educational-institutions.research-groups.research-teams.projects.research-outputs'=> ResearchOutputController::class,
        'nodes.educational-institutions.users'                                          => EducationalInstitutionUserController::class,

        'knowledge-areas'                   => KnowledgeAreaController::class,
        'knowledge-subareas'                => KnowledgeSubareaController::class,
        'knowledge-subarea-disciplines'     => KnowledgeSubareaDisciplinesController::class,
        'roles'                             => RoleController::class,
    ]);
});
