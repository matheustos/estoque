<?php

namespace App\Modules\Almoxarifados\Controllers;
use App\Modules\Almoxarifados\Services\AlmoxarifadosService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Empresas\Models\Empresa;

class AlmoxarifadosController extends Controller{
    
    protected $almoxarifadosService;

    public function __construct(AlmoxarifadosService $almoxarifadosService){
        $this->almoxarifadosService = $almoxarifadosService;
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'empresa_id' => 'required|integer|max: 100',
            'nome' => 'required|string|max: 255',
            'endereco' => 'required|string|max: 255'
        ]);

        $almoxarifado = $this->almoxarifadosService->cadastrarAlmoxarifado($validateData);

        if($almoxarifado){
            return response()->json(['success' => true, 'message' => 'Almoxarifado cadastrado com sucesso!', 'data' => $almoxarifado], 200);
        }

        return response()->json(['success' => false, 'message' => 'Erro ao cadastrar almoxarifado'], 500);
    }

    public function index(){
        $almoxarifados = $this->almoxarifadosService->buscarTodos();

        if($almoxarifados){
            return response()->json(['success' => true, 'message' => 'Almoxarifados encontrados:', 'data' => $almoxarifados], 200);
        }

        return response()->json(['success' => false, 'message' => 'Nenhum almoxarifado encontrado!'], 404);
    }

    public function show($id){
        $almoxarifado = $this->almoxarifadosService->buscarPorId($id);

        if($almoxarifado){
            return response()->json(['success' => true, 'message' => 'Almoxarifado encontrado:', 'data' => $almoxarifado], 200);
        }

        return response()->json(['success' => false, 'message' => 'Nenhum almoxarifado encontrado!'], 404);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'empresa_id' => 'sometimes|integer|max: 100',
            'nome' => 'sometimes|string|max: 255',
            'endereco' => 'sometimes|string|max: 255'
        ]);

        if($request["empresa_id"]){
            $empresa = Empresa::find($request["empresa_id"]);
            if(!$empresa){
                return response()->json(['success' => false, 'message' => 'Não existe empresa com esse id!'], 404);
            }
        }
        
        $almoxarifado = $this->almoxarifadosService->atualizarAlmoxarifado($validateData, $id);

        if($almoxarifado){
            return response()->json(['success' => true, 'message' => 'Almoxarifado atualizado com sucesso!', 'data' => $almoxarifado], 200);
        }

        return response()->json(['success' => false, 'message' => 'Nenhum almoxarifado encontrado!'], 404);
    }

    public function destroy($id)
    {
        $produto = $this->almoxarifadosService->deleteAlmoxarifado($id);
        if($produto){
            return response()->json(['message' => 'Almoxarifado deletado com sucesso!']);
        }
        return response()->json(['message' => 'Almoxarifado não encontrado!']);
    }
}