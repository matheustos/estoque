<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Movimentacoes\Controllers\MovimentacoesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/movimentacoes', [MovimentacoesController::class, 'store']);
    Route::get('/movimentacoes', [MovimentacoesController::class, 'index']);
    Route::get('/movimentacoes/{id}', [MovimentacoesController::class, 'show']);
    Route::put('/movimentacoes/{id}', [MovimentacoesController::class, 'update']);
    Route::delete('/movimentacoes/{id}', [MovimentacoesController::class, 'destroy']);
});