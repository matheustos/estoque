<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Movimentacoes\Controllers\MovimentacoesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/movimentacoes', [MovimentacoesController::class, 'store']);
    //Route::get('/estoque', [EstoquesController::class, 'index']);
    //Route::get('/estoque/{id}', [EstoquesController::class, 'show']);
    //Route::put('/estoque/{id}', [EstoquesController::class, 'update']);
    //Route::delete('/estoque/{id}', [EstoquesController::class, 'destroy']);
});