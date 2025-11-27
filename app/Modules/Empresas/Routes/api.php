<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Empresas\Controllers\EmpresasController;

// Rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('/empresas', [EmpresasController::class, 'store'])
    ;//->middleware('acesso:criar_empresas');
    Route::get('/empresas', [EmpresasController::class, 'index']);
    //->middleware('acesso:ver_empresas');
    Route::get('/empresas/{id}', [EmpresasController::class, 'show']);
    //->middleware('acesso:ver_empresas_id');
    Route::put('/empresas/{id}', [EmpresasController::class, 'update']);
    //->middleware('acesso:editar_empresas');
    Route::delete('/empresas/{id}', [EmpresasController::class, 'destroy']);
    //->middleware('acesso:deletar_empresas');
});