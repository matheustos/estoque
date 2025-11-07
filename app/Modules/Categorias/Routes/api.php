<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Categorias\Controllers\CategoriasController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/categorias',  [CategoriasController::class, 'store']);
    Route::get('/categorias',  [CategoriasController::class, 'index']);
    Route::get('/categorias/{id}',  [CategoriasController::class, 'show']);
    Route::put('/categorias/{id}', [CategoriasController::class, 'update']);
    Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy']);
});