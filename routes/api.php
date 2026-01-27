<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DostavljacController;
use App\Http\Controllers\RestoranController;
use App\Http\Controllers\StavkaPorudzbineController;
use App\Http\Controllers\JeloController;
use App\Http\Controllers\RecenzijaController;
use App\Http\Controllers\PorudzbinaController;


//ovo je ruta za dobijanje svih dostavljaca
/*
Route::get('/dostavljaci', [DostavljacController::class, 'index']);    
Route::get('/dostavljaci/{id}', [DostavljacController::class, 'show']);        
Route::post('/dostavljaci', [DostavljacController::class, 'store']);
Route::put('/dostavljaci/{id}', [DostavljacController::class, 'update']);  
Route::delete('/dostavljaci/{id}', [DostavljacController::class, 'destroy']); 
 */
Route::apiResource('dostavljaci', DostavljacController::class);
Route::apiResource('restorani', RestoranController::class);
Route::apiResource('stavke-porudzbine', StavkaPorudzbineController::class);
Route::apiResource('jela', JeloController::class);
Route::apiResource('recenzije', RecenzijaController::class);
Route::apiResource('porudzbine', PorudzbinaController::class);


