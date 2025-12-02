<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Estoque\Controllers\EstoquesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/estoque', [EstoquesController::class, 'store'])
    ->middleware('acesso:criar_estoque');
    Route::get('/estoque/{id}', [EstoquesController::class, 'show'])
    ->middleware('acesso:ver_estoque_id');
    Route::put('/estoque/{id}', [EstoquesController::class, 'update'])
    ->middleware('acesso:atualizar_estoque');
    Route::delete('/estoque/{id}', [EstoquesController::class, 'destroy'])
    ->middleware('acesso:deletar_estoque');
    Route::get('/estoque/alertas', [EstoquesController::class, 'alertasEstoqueGeral']);
});