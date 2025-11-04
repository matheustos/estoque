<?php

namespace App\Modules\Empresas\Controllers;
use App\Modules\Empresas\Services\EmpresasService;
use Illuminate\Http\Request;

class EmpresasController{

    protected $empresasService;
    public function __construct(EmpresasService $empresasService){
        $this->empresasService = $empresasService;
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
        return response()->json(['message' => 'Erro ao cadastrar empresa!'], 500);
    }
}