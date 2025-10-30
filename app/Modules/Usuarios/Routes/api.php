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
});

//rotas exclusivas para administradores
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/usuarios', [UsuariosController::class, 'index']);
    Route::get('/usuarios/{id}', [UsuariosController::class, 'show']);
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy']);
});
