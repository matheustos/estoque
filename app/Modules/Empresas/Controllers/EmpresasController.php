<?php

namespace App\Modules\Empresas\Controllers;
use App\Modules\Empresas\Services\EmpresasService;
use Illuminate\Http\Request;

class EmpresasController{

    protected $empresasService;
    public function __construct(EmpresasService $empresasService){
        $this->empresasService = $empresasService;
    }

    public function index(){
        $empresas = $this->empresasService->buscarTodas();

        if($empresas){
            return response()->json(['Empresas encontradas:' => $empresas], 200);
        }
        return response()->json(['message' => 'Nenhuma empresa encontrada!'], 404);
    }

    public function show($id){
        $empresa = $this->empresasService->buscarPorId($id);

        if($empresa){
            return response()->json(['message' => 'Empresa encontrada com sucesso!', 'empresa' => $empresa], 200);
        }
        return response()->json(['message' => 'Nenhuma empresa encontrada!'], 404);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        date_default_timezone_set('America/Sao_Paulo');
        $validateData['data_criacao'] = date('Y-m-d H:i:s');

        $empresa = $this->empresasService->cadastrarEmpresa($validateData);
        if($empresa){
            return response()->json(['message' => 'Empresa cadastrada com sucesso!', 'empresa' => $empresa], 200);
        }
        return response()->json(['message' => 'Erro ao cadastrar empresa!'], 404);
    }

    public function update($id, Request $request){
        $validateData = $request->validate([
            'nome' => 'sometimes|string|max:255'
        ]);

        $empresa = $this->empresasService->atualizarEmpresa($id, $validateData);

        if($empresa){
            return response()->json(['message' => 'Empresa atualizada com sucesso!', 'empresa' => $empresa], 200);
        }
        return response()->json(['message' => 'Erro ao atualizar empresa!'], 500);
    }

    public function destroy($id){

        $empresa = $this->empresasService->deletarEmpresa($id);

        if($empresa){
            return response()->json(['message' => 'Empresa deletada com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao deletar empresa!'], 500);
    }
}