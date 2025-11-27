<?php

namespace App\Modules\Papeis\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Papeis\Services\PapeisPermissoesService;
use App\Retorno\Retorno;
use App\Modules\Papeis\Models\Papel;

class PapeisPermissoesController extends Controller
{
    protected $papeisPermissoesService;

    public function __construct(PapeisPermissoesService $papeisPermissoesService)
    {
        $this->papeisPermissoesService = $papeisPermissoesService;
    }

    public function atribuirPermissoes(Request $request)
    {
        $validateData = $request->validate([
            'permissao_id' => 'required|array',
            'permissao_id.*' => 'integer|exists:permissoes,id',
            'papel_id' => 'required|integer|exists:papeis,id'
        ]);

        $resultado = $this->papeisPermissoesService->atribuirPermissoesAoPapel($validateData);
        $papel = Papel::with('permissoes')->find($validateData['papel_id']);

        if($resultado){
            return Retorno::sucesso('Permissões atribuídas com sucesso', ['papel' => $papel->nome, 'permissao' => $resultado], 200);
        }
        return Retorno::erro('Falha ao atribuir permissões', 500);
    }
}