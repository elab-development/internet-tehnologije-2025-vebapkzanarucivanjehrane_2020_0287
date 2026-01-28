<?php

use App\Http\Controllers\DostavljacController;
use App\Http\Controllers\JeloController;
use App\Http\Controllers\PorudzbinaController;
use App\Http\Controllers\RestoranController;
use App\Http\Controllers\StavkaPorudzbineController;
use App\Http\Controllers\RecenzijaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AuthController;
// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//ovo su rute koje zahtevaju autentifikaciju, da bi se pristupilo ovim rutama, korisnik mora imati token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});



Route::get('/restorani', [RestoranController::class, 'index']);
Route::get('/restorani/{id}', [RestoranController::class, 'show']);
Route::post('/restorani', [RestoranController::class, 'store']);
Route::put('/restorani/{id}', [RestoranController::class, 'update']);
Route::delete('/restorani/{id}', [RestoranController::class, 'destroy']);

Route::get('/dostavljaci', [DostavljacController::class, 'index']);
Route::get('/dostavljaci/{id}', [DostavljacController::class, 'show']);
Route::post('/dostavljaci', [DostavljacController::class, 'store']);
Route::put('/dostavljaci/{id}', [DostavljacController::class, 'update']);
Route::delete('/dostavljaci/{id}', [DostavljacController::class, 'destroy']);

Route::get('/jela', [JeloController::class, 'index']);
Route::get('/jela/{id}', [JeloController::class, 'show']);
Route::post('/jela', [JeloController::class, 'store']);
Route::put('/jela/{id}', [JeloController::class, 'update']);
Route::delete('/jela/{id}', [JeloController::class, 'destroy']);

Route::get('/porudzbine', [PorudzbinaController::class, 'index']);
Route::get('/porudzbine/{id}', [PorudzbinaController::class, 'show']);
Route::post('/porudzbine', [PorudzbinaController::class, 'store']);
Route::put('/porudzbine/{id}', [PorudzbinaController::class, 'update']);
Route::delete('/porudzbine/{id}', [PorudzbinaController::class, 'destroy']);

Route::get('/stavke_porudzbine', [App\Http\Controllers\StavkaPorudzbineController::class, 'index']);
Route::get('/stavke_porudzbine/{id}', [App\Http\Controllers\StavkaPorudzbineController::class, 'show']);
Route::post('/stavke_porudzbine', [App\Http\Controllers\StavkaPorudzbineController::class, 'store']);
Route::put('/stavke_porudzbine/{id}', [App\Http\Controllers\StavkaPorudzbineController::class, 'update']);
Route::delete('/stavke_porudzbine/{id}', [App\Http\Controllers\StavkaPorudzbineController::class, 'destroy']);

Route::get('/recenzije', [App\Http\Controllers\RecenzijaController::class, 'index']);
Route::get('/recenzije/{id}', [App\Http\Controllers\RecenzijaController::class, 'show']);
Route::post('/recenzije', [App\Http\Controllers\RecenzijaController::class, 'store']);
Route::put('/recenzije/{id}', [App\Http\Controllers\RecenzijaController::class, 'update']);
Route::delete('/recenzije/{id}', [App\Http\Controllers\RecenzijaController::class, 'destroy']);

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

