<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Empresas\Controllers\EmpresasController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/empresas', [EmpresasController::class, 'store']);
    /*Route::get('/fornecedores', [FornecedoresController::class, 'index']);
    Route::get('/fornecedores/{id}', [FornecedoresController::class, 'show']);
    Route::put('/fornecedores/{id}', [FornecedoresController::class, 'update']);
    Route::delete('/fornecedores/{id}', [FornecedoresController::class, 'destroy']);*/
});