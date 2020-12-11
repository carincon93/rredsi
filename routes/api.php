<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\KnowledgeAreasController;
use App\Http\Controllers\Api\KnowledgeSubareasController;
use App\Http\Controllers\Api\KnowledgeSubareaDiciplinesController;
use App\Http\Controllers\Api\EducationalInstitutionController;
use App\Http\Controllers\Api\AcademicProgramController;
use App\Http\Controllers\Api\FacultiesController;


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
    'nodes.educational-institutions.faculties' => FacultiesController::class,
    'nodes.educational-institutions.academic-programs' => AcademicProgramController::class,
    'knowledge-areas' => KnowledgeAreasController::class,
    'knowledge-areas.knowledge-subareas' => KnowledgeSubareasController::class,
    'knowledge-areas.knowledge-subareas.knowledge-subarea-disciplines' => KnowledgeSubareaDiciplinesController::class,

]);
