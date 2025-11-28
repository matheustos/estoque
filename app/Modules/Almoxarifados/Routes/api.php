<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Almoxarifados\Controllers\AlmoxarifadosController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::get('/almoxarifados/{id}',  [AlmoxarifadosController::class, 'show'])
    ->middleware('acesso: ver_almoxarifado_id');
    Route::post('/almoxarifados', [AlmoxarifadosController::class, 'store'])
    ->middleware('acesso: criar_almoxarifado');
    Route::get('/almoxarifados', [AlmoxarifadosController::class, 'index'])
    ->middleware('acesso: ver_almoxarifados');
    Route::put('/almoxarifados/{id}', [AlmoxarifadosController::class, 'update'])
    ->middleware('acesso: atualizar_almoxarifado');
    Route::delete('/almoxarifados/{id}', [AlmoxarifadosController::class, 'destroy'])
    ->middleware('acesso: deletar_almoxarifado');
});