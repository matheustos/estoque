<?php

namespace App\Modules\Papeis\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Papeis\Services\PapeisService;
use Illuminate\Http\Request;
use App\Retorno\Retorno;

class PapeisController extends Controller
{
    protected $papeisService;

    public function __construct(PapeisService $papeisService)
    {
        $this->papeisService = $papeisService;
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'empresa_id' => 'required|integer|exists:empresas,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $papel = $this->papeisService->criarPapel($validateData);

        if($papel){
            Retorno::sucesso('Papel criado com sucesso', $papel, 200);
        }
        Retorno::erro('Falha ao criar papel', 500);
    }
}