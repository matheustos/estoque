<?php

namespace App\Modules\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Modules\Usuarios\Models\Usuario;
use App\Modules\Usuarios\Services\UsuariosService;
use App\Retorno\Retorno;
use App\Modules\Papeis\Models\Papel;

class AuthController extends Controller
{
    protected $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'empresa_id' => 'nullable|integer|exists:empresas,id',
            'papel_id' => 'required|integer|max:255',
            'nome'  => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:6',
        ]);

        $papel = Papel::where('empresa_id', $validateData['empresa_id'])
            ->where('id', $validateData['papel_id'])
            ->first();
        $validateData['role'] = $papel->nome;
        $usuario = Usuario::create($validateData);
        return Retorno::sucesso('Usuário registrado com sucesso', $usuario, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return Retorno::erro('Credenciais inválidas', 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return Retorno::sucesso('Usuário autenticado', JWTAuth::user(), 200);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return Retorno::sucesso('Logout realizado com sucesso', null, 200);
    }

    public function resetPassword(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);

        $senhaAtualizada = $this->usuariosService->resetarSenha($validatedData['email']);

        if($senhaAtualizada){
            return Retorno::sucesso('Senha resetada com sucesso! Verifique seu email.', $senhaAtualizada, 200);
        } else {
            return Retorno::erro('Usuário não encontrado', 404);
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
            return Retorno::sucesso('Senha atualizada com sucesso!', null, 200);
        } else {
            return Retorno::erro('Usuário não encontrado', 404);
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
