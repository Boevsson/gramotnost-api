<?php

use Illuminate\Http\Request;
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

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::get('/users', [\App\Http\Controllers\UserController::class, 'getAll']);
Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'getOne']);

Route::get('/answers', [\App\Http\Controllers\AnswerController::class, 'getAll']);
Route::get('/answers/{id}', [\App\Http\Controllers\AnswerController::class, 'getOne']);

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'getAll']);
Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'getOne']);
Route::get('/categories/{id}/questions', [\App\Http\Controllers\CategoryController::class, 'getQuestions']);

Route::get('/challenges', [\App\Http\Controllers\ChallengeController::class, 'getAll']);
Route::get('/challenges/{id}', [\App\Http\Controllers\ChallengeController::class, 'getOne']);
Route::get('/challenges/{id}/subsections', [\App\Http\Controllers\ChallengeController::class, 'getSubsections']);

Route::get('/general-settings', [\App\Http\Controllers\GeneralController::class, 'getOne']);

Route::get('/questions', [\App\Http\Controllers\QuestionController::class, 'getAll']);
Route::get('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'getOne']);
Route::post('/questions', [\App\Http\Controllers\QuestionController::class, 'store']);
Route::post('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'update']);
Route::post('/reorder-questions', [\App\Http\Controllers\QuestionController::class, 'reorder']);
Route::delete('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'delete']);

Route::get('/questionnaire-questions', [\App\Http\Controllers\QuestionnaireQuestionController::class, 'getAll']);
Route::get('/questionnaire-questions/{id}', [\App\Http\Controllers\QuestionnaireQuestionController::class, 'getOne']);

Route::get('/question-types', [\App\Http\Controllers\QuestionTypeController::class, 'getAll']);
Route::get('/question-types/{id}', [\App\Http\Controllers\QuestionTypeController::class, 'getOne']);

Route::get('/subsections', [\App\Http\Controllers\SubsectionController::class, 'getAll']);
Route::get('/subsections/{id}', [\App\Http\Controllers\SubsectionController::class, 'getOne']);
Route::get('/subsections/{id}/categories', [\App\Http\Controllers\SubsectionController::class, 'getCategories']);

Route::get('/pages', [\App\Http\Controllers\PageController::class, 'getAll']);
Route::get('/pages/{slug}', [\App\Http\Controllers\PageController::class, 'getOne']);

Route::get('/files/{slug}', [\App\Http\Controllers\FileController::class, 'getOne']);

Route::get('/visits', [\App\Http\Controllers\VisitController::class, 'getOne']);
Route::post('/visits', [\App\Http\Controllers\VisitController::class, 'update']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/general-settings', [\App\Http\Controllers\GeneralController::class, 'update']);

    Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
    Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete']);

    Route::post('/pages', [\App\Http\Controllers\PageController::class, 'store']);
    Route::post('/pages/{id}', [\App\Http\Controllers\PageController::class, 'update']);
    Route::delete('/pages/{id}', [\App\Http\Controllers\PageController::class, 'delete']);
    Route::delete('/file/{id}', [\App\Http\Controllers\PageController::class, 'deleteFile']);

    Route::post('/subsections', [\App\Http\Controllers\SubsectionController::class, 'store']);
    Route::put('/subsections/{id}', [\App\Http\Controllers\SubsectionController::class, 'update']);
    Route::delete('/subsections/{id}', [\App\Http\Controllers\SubsectionController::class, 'delete']);

    Route::post('/question-types', [\App\Http\Controllers\QuestionTypeController::class, 'store']);
    Route::put('/question-types/{id}', [\App\Http\Controllers\QuestionTypeController::class, 'update']);
    Route::delete('/question-types/{id}', [\App\Http\Controllers\QuestionTypeController::class, 'delete']);

    Route::post('/questionnaire-questions', [\App\Http\Controllers\QuestionnaireQuestionController::class, 'store']);
    Route::put('/questionnaire-questions/{id}', [\App\Http\Controllers\QuestionnaireQuestionController::class, 'update']);
    Route::delete('/questionnaire-questions/{id}', [\App\Http\Controllers\QuestionnaireQuestionController::class, 'delete']);

    Route::post('/questions', [\App\Http\Controllers\QuestionController::class, 'store']);
    Route::post('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'update']);
    Route::delete('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'delete']);

    Route::post('/challenges', [\App\Http\Controllers\ChallengeController::class, 'store']);
    Route::put('/challenges/{id}', [\App\Http\Controllers\ChallengeController::class, 'update']);
    Route::delete('/challenges/{id}', [\App\Http\Controllers\ChallengeController::class, 'delete']);

    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::put('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'delete']);

    Route::post('/answers', [\App\Http\Controllers\AnswerController::class, 'store']);
    Route::put('/answers/{id}', [\App\Http\Controllers\AnswerController::class, 'update']);
    Route::delete('/answers/{id}', [\App\Http\Controllers\AnswerController::class, 'delete']);
});
