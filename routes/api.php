<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\KnowledgeAreaController;
use App\Http\Controllers\Api\KnowledgeSubareaController;
use App\Http\Controllers\Api\KnowledgeSubareaDisciplineController;
use App\Http\Controllers\Api\EducationalInstitutionController;
use App\Http\Controllers\Api\AcademicProgramController;
use App\Http\Controllers\Api\EducationalInstitutionFacultyController;
use App\Http\Controllers\Api\ResearchTeamController;
use App\Http\Controllers\Api\ProjectController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'nodes' => NodeController::class,
    'nodes.educational-institutions' => EducationalInstitutionController::class,
    'nodes.educational-institutions.faculties' => EducationalInstitutionFacultyController::class,
    'nodes.educational-institutions.faculties.research-teams' => ResearchTeamController::class,
    'nodes.educational-institutions.faculties.academic-programs' => AcademicProgramController::class,
    'knowledge-areas' => KnowledgeAreaController::class,
    'knowledge-areas.knowledge-subareas' => KnowledgeSubareaController::class,
    'knowledge-areas.knowledge-subareas.knowledge-subarea-disciplines' => KnowledgeSubareaDisciplineController::class,
    'projects.authors' => ProjectController::class,
]);
