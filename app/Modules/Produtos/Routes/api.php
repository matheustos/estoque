<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Produtos\Controllers\ProdutosController;
use App\Modules\Estoque\Controllers\EstoquesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/produtos', [ProdutosController::class, 'store']);
    Route::get('/produtos', [EstoquesController::class, 'index']);
    Route::get('/produtos/{id}', [ProdutosController::class, 'show']);
    Route::put('/produtos/{id}', [ProdutosController::class, 'update']);
    Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy']);
});