<?php
namespace App\Modules\Usuarios\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Services\UsuariosService;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    protected $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    public function index(){
        $usuarios = $this->usuariosService->listarUsuarios();
        if($usuarios){
            return response()->json($usuarios, 200);
        } else {
            return response()->json(['message' => 'Nenhum usuário encontrado'], 404);
        }
    }

    public function show($id){
        $usuario = $this->usuariosService->pegarUsuarioPorId($id);

        if($usuario){
            return response()->json($usuario, 200);
        } else {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
    }

    public function update($id, Request $request){
        $validatedData = $request->validate([
            'empresa_id' => 'nullable|integer|exists:empresas,id',
            'papel_id' => 'nullable|integer|exists:papeis,id',
            'nome'  => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:usuarios,email,'.$id,
            'role' => 'sometimes|required|string'
        ]);
        $usuario = $this->usuariosService->atualizarUsuario($id, $validatedData);

        if($usuario){
            return response()->json($usuario, 200);
        } else {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
    }

    public function destroy($id){
        $usuario = $this->usuariosService->deletarUsuario($id);

        if($usuario){
            return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
        }
        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }

    
}