<?php

namespace App\Modules\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Modules\Usuarios\Models\Usuario;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'empresa_id' => 'nullable|integer|exists:empresas,id',
            'papel_id' => 'nullable|integer|exists:papeis,id',
            'nome'  => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:6',
        ]);

        if(!$request->role){
            $data['role'] = 'user';
        }

        $usuario = Usuario::create($data);
        return response()->json($usuario, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(JWTAuth::user());
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user'         => JWTAuth::user(),
        ]);
    }
}
