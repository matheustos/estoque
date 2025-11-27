<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Produtos\Controllers\ProdutosController;
use App\Modules\Estoque\Controllers\EstoquesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/produtos', [ProdutosController::class, 'store'])
    ->middleware('acesso:criar_produto');
    Route::get('/produtos', [EstoquesController::class, 'index'])
    ->middleware('acesso:ver_produtos');
    Route::get('/produtos/{id}', [ProdutosController::class, 'show'])
    ->middleware('acesso:ver_produtos_id');
    Route::put('/produtos/{id}', [ProdutosController::class, 'update'])
    ->middleware('acesso:atualizar_produtos');
    Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy'])
    ->middleware('acesso:deletar_produtos');
});