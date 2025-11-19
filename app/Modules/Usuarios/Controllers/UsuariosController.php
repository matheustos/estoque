<?php
namespace App\Modules\Usuarios\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Services\UsuariosService;
use Illuminate\Http\Request;
use App\Retorno\Retorno;

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
            return Retorno::sucesso('Lista de usuários obtida com sucesso', $usuarios, 200);
        } else {
            return Retorno::erro('Nenhum usuário encontrado', 404);
        }
    }

    public function show($id){
        $usuario = $this->usuariosService->pegarUsuarioPorId($id);

        if($usuario){
            return Retorno::sucesso('Usuário obtido com sucesso', $usuario, 200);
        } else {
            return Retorno::erro('Usuário não encontrado', 404);
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
            return Retorno::sucesso('Usuário atualizado com sucesso', $usuario, 200);
        } else {
            return Retorno::erro('Usuário não encontrado ou dados inválidos', 404);
        }
    }

    public function destroy($id){
        $usuario = $this->usuariosService->deletarUsuario($id);

        if($usuario){
            return Retorno::sucesso('Usuário deletado com sucesso', null, 200);
        }
        return Retorno::erro('Usuário não encontrado', 404);
    }

    
}