<?php

use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Movimentacoes\Controllers\MovimentacoesController;
use Illuminate\Support\Facades\Route;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::get('/dashboard/cards', [DashboardController::class, 'filtrarProdutos']);
    //->middleware('acesso:ver_dashboard');
    Route::get('/dashboard/alertas', [DashboardController::class, 'alertasEstoqueGeral']);
    //->middleware('acesso:ver_alertas_dashboard');
    Route::get('/dashboard/movimentacoes', [MovimentacoesController::class, 'index']);
    //->middleware('acesso:ver_movimentacoes');
});