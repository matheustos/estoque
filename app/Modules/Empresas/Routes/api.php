<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Empresas\Controllers\EmpresasController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/empresas', [EmpresasController::class, 'store']);
    Route::get('/empresas', [EmpresasController::class, 'index']);
    Route::get('/empresas/{id}', [EmpresasController::class, 'show']);
    Route::put('/empresas/{id}', [EmpresasController::class, 'update']);
    Route::delete('/empresas/{id}', [EmpresasController::class, 'destroy']);
});