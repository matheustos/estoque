<?php

use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Movimentacoes\Controllers\MovimentacoesController;
use Illuminate\Support\Facades\Route;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::get('/dashboard/cards', [DashboardController::class, 'quantidadeProdutos']);
    Route::get('/dashboard/alertas', [DashboardController::class, 'alertasEstoqueGeral']);
    Route::get('/dashboard/movimentacoes', [MovimentacoesController::class, 'index']);
});