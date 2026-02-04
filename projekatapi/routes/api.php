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
use App\Models\User;

use App\Http\Controllers\AuthController;
// Authentication routes, javne rute 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//ruta za otvaranje Menu-a na stranici RestaurantDetails
Route::get('/restorani/{id}/jela', [JeloController::class, 'jelaZaRestoran']);

//JAVNE RUTE:

Route::get('/restorani', [RestoranController::class, 'index']);     
Route::get('/restorani/{id}', [RestoranController::class, 'show']); 
Route::get('/jela', [JeloController::class, 'index']);
Route::get('/jela/{id}', [JeloController::class, 'show']);
Route::get('/porudzbine/{id}', [PorudzbinaController::class, 'show']);
Route::get('/recenzije', [RecenzijaController::class, 'index']);
Route::get('/recenzije/{id}', [RecenzijaController::class, 'show']);


//AUTENTIFIKOVANE RUTE:
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/dostavljaci', [DostavljacController::class, 'store']);
       
                
    Route::middleware('role:kupac')->group(function () {
        //SAMO KUPAC  
    Route::post('/restorani/{id}/recenzije', [RecenzijaController::class, 'store']);
    Route::post('/porudzbine', [PorudzbinaController::class, 'store']);
    Route::put('/porudzbine/{id}', [PorudzbinaController::class, 'update']);
    Route::post('/recenzije', [RecenzijaController::class, 'store']);
    });
    
    Route::middleware('role:admin')->group(function () {
        //SAMO ADMIN
//upravljanje restoranima:
    Route::post('/restorani', [RestoranController::class, 'store']);
    Route::put('/restorani/{id}', [RestoranController::class, 'update']);
    Route::delete('/restorani/{id}', [RestoranController::class, 'destroy']);
//upravljanje dostavljacima:  sve
Route::get('/dostavljaci', [DostavljacController::class, 'index']);
Route::get('/dostavljaci/{id}', [DostavljacController::class, 'show']);
Route::put('/dostavljaci/{id}', [DostavljacController::class, 'update']);
Route::delete('/dostavljaci/{id}', [DostavljacController::class, 'destroy']);
//upravljanje jelima:
Route::post('/jela', [JeloController::class, 'store']);
Route::put('/jela/{id}', [JeloController::class, 'update']);
Route::delete('/jela/{id}', [JeloController::class, 'destroy']);
//upravljanje porudzbinama:
Route::get('/porudzbine', [PorudzbinaController::class, 'index']);
Route::put('/porudzbine/{id}', [PorudzbinaController::class, 'update']);
Route::delete('/porudzbine/{id}', [PorudzbinaController::class, 'destroy']);
//upravljanje stavkama porudzbine:
Route::get('/stavke_porudzbine', [StavkaPorudzbineController::class, 'index']);
Route::get('/stavke_porudzbine/{id}', [StavkaPorudzbineController::class, 'show']);
Route::post('/stavke_porudzbine', [StavkaPorudzbineController::class, 'store']);
Route::put('/stavke_porudzbine/{id}', [StavkaPorudzbineController::class, 'update']);
Route::delete('/stavke_porudzbine/{id}', [StavkaPorudzbineController::class, 'destroy']);
//upravljanje korisnicima:
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
//upravljanje recenzijama:
Route::put('/recenzije/{id}', [RecenzijaController::class, 'update']);
Route::delete('/recenzije/{id}', [RecenzijaController::class, 'destroy']);

    });
});




