<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Papeis\Controllers\PapeisController;
use App\Modules\Papeis\Controllers\PermissoesController;
use App\Modules\Papeis\Controllers\PapeisPermissoesController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/papeis', [PapeisController::class, 'store'])
    ->middleware('acesso:criar_papeis');
    Route::post('/permissoes', [PapeisPermissoesController::class, 'atribuirPermissoes'])
    ->middleware('acesso:criar_permissoes');
    Route::get('/permissoes', [PermissoesController::class, 'index'])
    ->middleware('acesso:ver_permissoes');
});