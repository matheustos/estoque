<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessMiddleware
{
    public function handle(Request $request, Closure $next, $permissao)
    {
        $user = auth()->user();

        // Se não estiver logado → bloqueia
        if (!$user) {
            return response()->json(['error' => 'Não autenticado'], 401);
        }

        // ADMIN sempre tem acesso total
        if ($user->papel->nome === 'admin') {
            return $next($request);
        }

        // Usuário comum → só entra se tiver a permissão
        if (!$user->hasPermission($permissao)) {
            return response()->json([
                'error' => 'Você não tem permissão para acessar esta funcionalidade.'
            ], 403);
        }

        return $next($request);
    }
}
