<?php

namespace App\Modules\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Modules\Usuarios\Models\Usuario;
use App\Modules\Usuarios\Services\UsuariosService;

class AuthController extends Controller
{
    protected $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

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
        return response()->json(JWTAuth::user()->id);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function resetPassword(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);

        $senhaAtualizada = $this->usuariosService->resetarSenha($validatedData['email']);

        if($senhaAtualizada){
            return response()->json(['message' => 'Nova senha enviado por email!', 'usuário' => $senhaAtualizada], 200);
        } else {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
    }

    // esse método será chamado caso o usuário LOGADO queira resetar a senha
    public function resetSenha(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $senhaAtualizada = $this->usuariosService->resetarSenhaLogado($validatedData['email'], $validatedData['password']);

        if ($senhaAtualizada) {
            return response()->json(['message' => 'Senha atualizada com sucesso!', 'usuário' => $senhaAtualizada], 200);
        } else {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
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
