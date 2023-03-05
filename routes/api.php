<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\SportsmanController;
use App\Http\Controllers\ParticipationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getUsers', [AuthController::class, 'getUsers']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/getDisciplinesByUserId/{id}', [DisciplineController::class, 'getDisciplinesByUserId']);
Route::get('/getDisciplineById/{id}', [DisciplineController::class, 'getDisciplineById']);
Route::get('/deleteDiscipline/{id}', [DisciplineController::class, 'deleteDiscipline']);
Route::post('/store', [DisciplineController::class, 'store']);
Route::post('/update/{id}', [DisciplineController::class, 'update']);
// Route::get('/getDisciplines', [DisciplineController::class, 'getDisciplines']);
// Route::post('/createOrUpdateDiscipline', [DisciplineController::class, 'createOrUpdateDiscipline']);



Route::get('/getSportsman', [SportsmanController::class, 'getSportsman']);
Route::post('/createOrUpdateSportsman', [SportsmanController::class, 'createOrUpdateSportsman']);
Route::get('/editSportsman/{id}', [SportsmanController::class, 'editSportsman']);
Route::get('/getSportsmenByUserId/{id}', [SportsmanController::class, 'getSportsmenByUserId']);
Route::get('/deleteSportsman/{id}', [SportsmanController::class, 'deleteSportsman']);


Route::get('/getParticipations', [ParticipationController::class, 'getParticipations']);
Route::get('/getParticipationByDisc/{id}', [ParticipationController::class, 'getParticipationByDisc']);
Route::get('/getParticipationByComp/{id}', [ParticipationController::class, 'getParticipationByComp']);
Route::post('/createOrUpdateParticipation', [ParticipationController::class, 'createOrUpdateParticipation']);
Route::post('/saveScore', [ParticipationController::class, 'saveScore']);
Route::get('/getDisciplinesWithSportsman/{id}', [ParticipationController::class, 'getDisciplinesWithSportsman']);
Route::get('/sportsmanWithDisc/{id}', [ParticipationController::class, 'sportsmanWithDisc']);
Route::get('/allDiscWithSportsman', [ParticipationController::class, 'allDiscWithSportsman']);
Route::get('/deleteParticipation/{id}', [ParticipationController::class, 'deleteParticipation']);

Route::get('/participationJoinedWithCompetitors/{id}', [ParticipationController::class, 'participationJoinedWithCompetitors']);
