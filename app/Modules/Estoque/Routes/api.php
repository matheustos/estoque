<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Estoque\Controllers\EstoquesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/estoque', [EstoquesController::class, 'store']);
    Route::get('/estoque/{id}', [EstoquesController::class, 'show']);
    Route::put('/estoque/{id}', [EstoquesController::class, 'update']);
    Route::delete('/estoque/{id}', [EstoquesController::class, 'destroy']);
});