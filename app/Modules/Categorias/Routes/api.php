<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Categorias\Controllers\CategoriasController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/categorias',  [CategoriasController::class, 'store'])
    ->middleware('acesso: criar_categoria');
    Route::get('/categorias',  [CategoriasController::class, 'index'])
    ->middleware('acesso: ver_categorias');
    Route::get('/categorias/{id}',  [CategoriasController::class, 'show'])
    ->middleware('acesso: ver_categoria_id');
    Route::put('/categorias/{id}', [CategoriasController::class, 'update'])
    ->middleware('acesso: atualizar_categoria');
    Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])
    ->middleware('acesso: deletar_categoria');
});