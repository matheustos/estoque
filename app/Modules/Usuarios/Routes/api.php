<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Controllers\AuthController;
use App\Modules\Usuarios\Controllers\UsuariosController;

//rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

//rotas exclusivas para usuários autenticados
Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/reset-senha', [AuthController::class, 'resetSenha']);
    Route::get('/usuarios', [UsuariosController::class, 'index'])
    ->middleware('acesso:ver_usuarios');
    Route::get('/usuarios/{id}', [UsuariosController::class, 'show'])
    ->middleware('acesso:ver_usuarios_id');
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])
    ->middleware('acesso:atualizar_usuarios');
    Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy'])
    ->middleware('acesso:deletar_usuarios');
});

