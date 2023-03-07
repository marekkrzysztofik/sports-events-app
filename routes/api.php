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
Route::get('getCoaches', [AuthController::class, 'getCoaches']); 
Route::post('register', [AuthController::class, 'register']);
Route::post('adminLogin', [AuthController::class, 'adminLogin']);
Route::post('coachLogin', [AuthController::class, 'coachLogin']);


Route::get('/getDisciplinesByUserId/{id}', [DisciplineController::class, 'getDisciplinesByUserId']);
Route::get('/getDisciplineById/{id}', [DisciplineController::class, 'getDisciplineById']);
Route::get('/deleteDiscipline/{id}', [DisciplineController::class, 'deleteDiscipline']);
Route::post('/createOrUpdateDiscipline', [DisciplineController::class, 'createOrUpdateDiscipline']);


Route::post('/createOrUpdateSportsman', [SportsmanController::class, 'createOrUpdateSportsman']);
Route::get('/getSportsmanById/{id}', [SportsmanController::class, 'getSportsmanById']);
Route::get('/getSportsmenByUserId/{id}', [SportsmanController::class, 'getSportsmenByUserId']);
Route::get('/deleteSportsman/{id}', [SportsmanController::class, 'deleteSportsman']);


Route::get('/getParticipationByCompetitor/{id}', [ParticipationController::class, 'getParticipationByCompetitor']);
Route::post('/createOrUpdateParticipation', [ParticipationController::class, 'createOrUpdateParticipation']);
Route::get('/getDisciplinesWithSportsman/{id}', [ParticipationController::class, 'getDisciplinesWithSportsman']);
Route::get('/sportsmanWithDiscipline/{id}', [ParticipationController::class, 'sportsmanWithDiscipline']);
Route::get('/deleteParticipation/{id}', [ParticipationController::class, 'deleteParticipation']);
Route::get('/participationJoinedWithCompetitors/{id}', [ParticipationController::class, 'participationJoinedWithCompetitors']);
