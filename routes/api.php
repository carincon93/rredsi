<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'API\LoginController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', function () {
        return Auth::user();
    });

    Route::resource('/academic-programs', 'AcademicProgramController');
    Route::resource('/academic-works', 'AcademicWorkController');
    Route::resource('/educational-environments', 'EducationalEnvironmentController');
    Route::get('/educational-environments/getByEducationalInstitution/{id}', 'EducationalEnvironmentController@getByEducationalInstitution');

    Route::get('/nodes/get-educational-institutions/{node}', 'NodeController@getEducationalInstitutions');
    Route::resource('/nodes', 'NodeController');

    Route::get('/educational-institutions/get-research-groups/{educationalInstitution}', 'EducationalInstitutionController@getResearchGroups');
    Route::get('/educational-institutions/get-academic-programs/{educationalInstitution}', 'EducationalInstitutionController@getAcademicPrograms');
    Route::get('/educational-institutions/get-research-lines/{researchGroup}', 'EducationalInstitutionController@getResearchLines');
    Route::resource('/educational-institutions', 'EducationalInstitutionController');

    Route::get('/research-groups/get-research-teams/{researchGroup}', 'ResearchGroupController@getResearchTeams');
    Route::resource('/research-groups', 'ResearchGroupController');

    Route::resource('/educational-tools', 'EducationalToolController');
    Route::resource('/events', 'EventController');
    Route::resource('/graduations', 'GraduationController');
    Route::resource('/knowledge-areas', 'KnowledgeAreaController');

    Route::resource('/loans', 'LoanController');

    Route::put('/loans/{loan}/check', 'LoanController@check');
    Route::put('/loans/{loan}/return', 'LoanController@return');
    Route::put('/loans/{loan}/returnCheck', 'LoanController@returnCheck');

    Route::get('/environment-loan-requests', 'LoanController@indexEnvironmentLoanRequest');
    Route::get('/environment-loan-requests/{educationalEnvironmentLoan}', 'LoanController@showEnvironmentLoanRequest');

    Route::get('/tool-loan-requests', 'LoanController@indexToolLoanRequest');
    Route::get('/tool-loan-requests/{educationalToolLoan}', 'LoanController@showToolLoanRequest');

    Route::post('/register-event', 'ProjectController@registerEvent');
    Route::resource('/projects', 'ProjectController');

    Route::resource('/researchers', 'ResearcherController');

    Route::resource('/research-lines', 'ResearchLineController');
    Route::resource('/research-outputs', 'ResearchOutputController');
    Route::resource('/research-teams', 'ResearchTeamController');

    Route::resource('/students', 'StudentController');
    Route::resource('/users', 'UserController');
    Route::resource('/research-team-admins', 'ResearchTeamAdminController');
    Route::resource('/educational-institution-admins', 'EducationalInstitutionAdminController');
    Route::resource('/node-admins', 'NodeAdminController');
});
