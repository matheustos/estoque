<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Almoxarifados\Controllers\AlmoxarifadosController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::get('/almoxarifados/{id}',  [AlmoxarifadosController::class, 'show']);
});

// Rotas protegidas apenas para admins
Route::middleware('auth:admin')->group(function(){
    Route::post('/almoxarifados', [AlmoxarifadosController::class, 'store']);
    Route::get('/almoxarifados', [AlmoxarifadosController::class, 'index']);
    Route::put('/almoxarifados/{id}', [AlmoxarifadosController::class, 'update']);
    Route::delete('/almoxarifados/{id}', [AlmoxarifadosController::class, 'destroy']);
});