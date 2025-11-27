<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Fornecedores\Controllers\FornecedoresController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/fornecedores', [FornecedoresController::class, 'store'])
    ->middleware('acesso:criar_fornecedores');
    Route::get('/fornecedores', [FornecedoresController::class, 'index'])
    ->middleware('acesso:ver_fornecedores');
    Route::get('/fornecedores/status', [FornecedoresController::class, 'filtrarFornecedores'])
    ->middleware('acesso:ver_status');
    Route::get('/fornecedores/{id}', [FornecedoresController::class, 'show'])
    ->middleware('acesso:ver_fornecedor_id');
    Route::put('/fornecedores/{id}', [FornecedoresController::class, 'update'])
    ->middleware('acesso:atualizar_fornecedores');
    Route::delete('/fornecedores/{id}', [FornecedoresController::class, 'destroy'])
    ->middleware('acesso:deletar_fornecedores');
});