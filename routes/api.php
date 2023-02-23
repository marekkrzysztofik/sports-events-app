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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/getDisc', [DisciplineController::class, 'getDisc']);
Route::post('/createDiscipline', [DisciplineController::class, 'createDiscipline']);
Route::post('/updateDisc/{id}', [DisciplineController::class, 'updateDisc']);
Route::post('/createOrUpdateDiscipline', [DisciplineController::class, 'createOrUpdateDiscipline']);
Route::get('/editDisc/{id}', [DisciplineController::class, 'editDisc']);
Route::get('/deleteDisc/{id}', [DisciplineController::class, 'deleteDisc']);




Route::get('/getSportsman', [SportsmanController::class, 'getSportsman']);
Route::post('/createSportsman', [SportsmanController::class, 'createSportsman']);
Route::post('/updateSportsman', [SportsmanController::class, 'updateSportsman']);
Route::post('/createOrUpdateSportsman', [SportsmanController::class, 'createOrUpdateSportsman']);
Route::get('/editSportsman/{id}', [SportsmanController::class, 'editSportsman']);
Route::get('/deleteSportsman/{id}', [SportsmanController::class, 'deleteSportsman']);


Route::get('/getParticipations', [ParticipationController::class, 'getParticipations']); 
Route::get('/getParticipationByDisc/{id}', [ParticipationController::class, 'getParticipationByDisc']);
Route::get('/getParticipationByComp/{id}', [ParticipationController::class, 'getParticipationByComp']);  
Route::post('/assignSportsman', [ParticipationController::class, 'assignSportsman']);
Route::post('/createOrUpdateParticipation', [ParticipationController::class, 'createOrUpdateParticipation']);
Route::post('/saveScore/{id}', [ParticipationController::class, 'saveScore']);
Route::get('/discWithSportsman/{id}', [ParticipationController::class, 'discWithSportsman']);
Route::get('/sportsmanWithDisc/{id}', [ParticipationController::class, 'sportsmanWithDisc']);
Route::get('/allDiscWithSportsman', [ParticipationController::class, 'allDiscWithSportsman']);
