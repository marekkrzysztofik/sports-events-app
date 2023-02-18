<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\SportsmanController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/getDisc', [DisciplineController::class, 'getDisc']);
Route::post('/createDiscipline', [DisciplineController::class, 'createDiscipline']);
Route::post('/updateDisc/{id}', [DisciplineController::class, 'updateDisc']);

Route::get('/editDisc/{id}', [DisciplineController::class, 'editDisc']); 
Route::get('/deleteDisc/{id}', [DisciplineController::class, 'deleteDisc']);  



Route::get('/getSportsman', [SportsmanController::class, 'getSportsman']);
Route::post('/createSportsman', [SportsmanController::class, 'createSportsman']);
Route::get('/editSportsman/{id}', [SportsmanController::class, 'editSportsman']); 
Route::get('/deleteSportsman/{id}', [SportsmanController::class, 'deleteSportsman']);