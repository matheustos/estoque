<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Movimentacoes\Controllers\MovimentacoesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/movimentacoes', [MovimentacoesController::class, 'store'])
    ->middleware('acesso:criar_movimentacoes');
    Route::get('/movimentacoes', [MovimentacoesController::class, 'index'])
    ->middleware('acesso:ver_movimentacoes');
    Route::put('/movimentacoes/{id}', [MovimentacoesController::class, 'update'])
    ->middleware('acesso:atualizar_movimentacoes');
    Route::delete('/movimentacoes/{id}', [MovimentacoesController::class, 'destroy'])
    ->middleware('acesso:deletar_movimentacoes');
});