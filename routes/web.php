<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\AcademicWorkController;
use App\Http\Controllers\EducationalEnvironmentController;
use App\Http\Controllers\EducationalInstitutionController;
use App\Http\Controllers\ResearchGroupController;
use App\Http\Controllers\EducationalToolController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\KnowledgeAreaController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\ResearchLineController;
use App\Http\Controllers\ResearchTeamController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/educational-environments/getByEducationalInstitution/{id}', [EducationalEnvironmentController::class, 'getByEducationalInstitution']);
    Route::get('/nodes/get-educational-institutions/{node}', [NodeController::class, 'getEducationalInstitutions']);
    Route::get('/educational-institutions/get-research-groups/{educationalInstitution}', [EducationalInstitutionController::class, 'getResearchGroups']);
    Route::get('/educational-institutions/get-academic-programs/{educationalInstitution}', [EducationalInstitutionController::class, 'getAcademicPrograms']);
    Route::get('/educational-institutions/get-research-lines/{researchGroup}', [EducationalInstitutionController::class, 'getResearchLines']);
    Route::get('/research-groups/get-research-teams/{researchGroup}', [ResearchGroupController::class, 'getResearchTeams']);
    Route::put('/loans/{loan}/check', [LoanController::class, 'check']);
    Route::put('/loans/{loan}/return', [LoanController::class, 'return']);
    Route::put('/loans/{loan}/returnCheck', [LoanController::class, 'returnCheck']);
    Route::get('/environment-loan-requests', [LoanController::class, 'indexEnvironmentLoanRequest']);
    Route::get('/environment-loan-requests/{educationalEnvironmentLoan}', [LoanController::class, 'showEnvironmentLoanRequest']);
    Route::get('/tool-loan-requests', [LoanController::class, 'indexToolLoanRequest']);
    Route::get('/tool-loan-requests/{educationalToolLoan}', [LoanController::class, 'showToolLoanRequest']);
    Route::get('/educational-institutions/get-academic-programs/{educationalInstitution}', [EducationalInstitutionController::class, 'getAcademicPrograms'])->name('educational-institutions.getAcademicPrograms');
    Route::post('/register-event', [ProjectController::class, 'registerEvent']);

    // To request graduation info
    Route::get('/request-grade-info', [GraduationController::class, 'requestGradeInfo']);

    Route::resources([
        'academic-programs'                 => AcademicProgramController::class,
        'academic-works'                    => AcademicWorkController::class,
        'educational-environments'          => EducationalEnvironmentController::class,
        'nodes'                             => NodeController::class,
        'educational-institutions'          => EducationalInstitutionController::class,
        'research-groups'                   => ResearchGroupController::class,
        'educational-tools'                 => EducationalToolController::class,
        'events'                            => EventController::class,
        'graduations'                       => GraduationController::class,
        'knowledge-areas'                   => KnowledgeAreaController::class,
        'projects'                          => ProjectController::class,
        'researchers'                       => ResearcherController::class,
        'research-lines'                    => ResearchLineController::class,
        'research-outputs'                  => ResearchOutputController::class,
        'research-teams'                    => ResearchTeamController::class,
        'students'                          => StudentController::class,
        'users'                             => UserController::class,
        'research-team-admins'              => ResearchTeamAdminController::class,
        'educational-institution-admins'    => EducationalInstitutionAdminController::class,
        'node-admins'                       => NodeAdminController::class,
    ]);
});
