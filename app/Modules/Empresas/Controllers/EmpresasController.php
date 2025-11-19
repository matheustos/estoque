<?php

namespace App\Modules\Empresas\Controllers;
use App\Modules\Empresas\Services\EmpresasService;
use Illuminate\Http\Request;
use App\Retorno\Retorno;

class EmpresasController{

    protected $empresasService;
    public function __construct(EmpresasService $empresasService){
        $this->empresasService = $empresasService;
    }

    public function index(){
        $empresas = $this->empresasService->buscarTodas();

        if($empresas){
            return Retorno::sucesso('Empresas encontradas com sucesso!', $empresas, 200);
        }
        return Retorno::erro('Nenhuma empresa encontrada!', 404);
    }

    public function show($id){
        $empresa = $this->empresasService->buscarPorId($id);

        if($empresa){
            return Retorno::sucesso('Empresa encontrada com sucesso!', $empresa, 200);
        }
        return Retorno::erro('Empresa não encontrada!', 404);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        date_default_timezone_set('America/Sao_Paulo');
        $validateData['data_criacao'] = date('Y-m-d H:i:s');

        $empresa = $this->empresasService->cadastrarEmpresa($validateData);
        if($empresa){
            return Retorno::sucesso('Empresa cadastrada com sucesso!', $empresa, 200);
        }
        return Retorno::erro('Erro ao cadastrar empresa!', 500);
    }

    public function update($id, Request $request){
        $validateData = $request->validate([
            'nome' => 'sometimes|string|max:255'
        ]);

        $empresa = $this->empresasService->atualizarEmpresa($id, $validateData);

        if($empresa){
            return Retorno::sucesso('Empresa atualizada com sucesso!', $empresa, 200);
        }
        return Retorno::erro('Erro ao atualizar empresa!', 500);
    }

    public function destroy($id){

        $empresa = $this->empresasService->deletarEmpresa($id);

        if($empresa){
            return Retorno::sucesso('Empresa deletada com sucesso!', null, 200);
        }
        return Retorno::erro('Erro ao deletar empresa!', 500);
    }
}