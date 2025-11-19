<?php

namespace App\Modules\Almoxarifados\Controllers;
use App\Modules\Almoxarifados\Services\AlmoxarifadosService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Retorno\Retorno;

class AlmoxarifadosController extends Controller{
    
    protected $almoxarifadosService;

    public function __construct(AlmoxarifadosService $almoxarifadosService){
        $this->almoxarifadosService = $almoxarifadosService;
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'empresa_id' => 'required|integer|exists:empresas,id',
            'nome' => 'required|string|max: 255',
            'endereco' => 'required|string|max: 255'
        ]);

        $almoxarifado = $this->almoxarifadosService->cadastrarAlmoxarifado($validateData);

        if($almoxarifado){
            return Retorno::sucesso('Almoxarifado cadastrado com sucesso!', $almoxarifado, 200);
        }

        return Retorno::erro('Erro ao cadastrar almoxarifado!', 500);
    }

    public function index(){
        $almoxarifados = $this->almoxarifadosService->buscarTodos();

        if($almoxarifados){
            return Retorno::sucesso('Almoxarifados encontrados:', $almoxarifados, 200);
        }

        return Retorno::erro('Nenhum almoxarifado encontrado!', 404);
    }

    public function show($id){
        $almoxarifado = $this->almoxarifadosService->buscarPorId($id);

        if($almoxarifado){
            return Retorno::sucesso('Almoxarifado encontrado:', $almoxarifado, 200);
        }

        return Retorno::erro('Nenhum almoxarifado encontrado!', 404);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'empresa_id' => 'sometimes|integer|exists:empresas,id',
            'nome' => 'sometimes|string|max: 255',
            'endereco' => 'sometimes|string|max: 255'
        ]);
        
        $almoxarifado = $this->almoxarifadosService->atualizarAlmoxarifado($validateData, $id);

        if($almoxarifado){
            return Retorno::sucesso('Almoxarifado atualizado com sucesso!', $almoxarifado, 200);
        }

        return Retorno::erro('Erro ao atualizar almoxarifado!', 500);
    }

    public function destroy($id)
    {
        $produto = $this->almoxarifadosService->deleteAlmoxarifado($id);
        if($produto){
            return Retorno::sucesso('Almoxarifado deletado com sucesso!', null, 200);
        }
        return Retorno::erro('Erro ao deletar almoxarifado!', 500);
    }
}