<?php

namespace App\Modules\Movimentacoes\Controllers;
use App\Modules\Movimentacoes\Services\MovimentacoesService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Modules\Estoque\Models\Estoque;
use App\Modules\Estoque\Controllers\EstoquesController;

class MovimentacoesController{
    protected $movimentacoesService;

    public function __construct(MovimentacoesService $movimentacoesService){
        $this->movimentacoesService = $movimentacoesService;
    }

    public function index(){
        $movimentacoes = $this->movimentacoesService->buscarTodos();

        if($movimentacoes){
            return response()->json(['success' => true, 'message' => 'Histórico de movimentações:', 'data' => $movimentacoes], 200);
        }
        return response()->json(['success' => false, 'message' => 'Nenhuma movimentação encontrada!'], 404);
    }

    public function show($id){
        $movimentacao = $this->movimentacoesService->buscarPorId($id);

        if($movimentacao){
            return response()->json(['success' => true, 'data' => $movimentacao], 200);
        }
        return response()->json(['success' => false, 'message' => 'Nenhuma movimentação encontrada!'], 404);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'produto_id' => 'required|integer|exists:produtos,id',
            'almoxarifado_id' => 'required|integer|exists:almoxarifados,id',
            'tipo' => 'required|string|max:255',
            'quantidade' => 'required|integer|max:255',
            'motivo' => 'required|string|max:255',
            'observacoes' => 'nullable|string|max:255'
        ]);

        $estoque = Estoque::where('produto_id', $validateData['produto_id'] ?? null)
            ->lockForUpdate()
            ->first();
        $saldo = $estoque->quantidade;

        if($validateData['quantidade'] > $saldo && $validateData['tipo'] === 'saida'){
            return response()->json(['success' => false, 'message' => 'A quantidade não pode ser superior ao estoque!'], 500);
        }

        if($validateData['quantidade'] <= 0){
            return response()->json(['success' => false, 'message' => 'A quantidade deve ser maior que zero!'], 500);
        }
        $usuarioId = JWTAuth::user()->id;
        $validateData['usuario_id'] = $usuarioId;

        $movimentacao = $this->movimentacoesService->novaMovimentacao($validateData);

        if($movimentacao){
            return response()->json(['success' => true, 'message' => 'Movimentação registrada com sucesso!', 'data' => $movimentacao], 200);
        }
        return response()->json(['success' => false, 'message' => 'Erro ao registrar movimentação!'], 500);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'produto_id' => 'sometimes|integer|exists:produtos,id',
            'almoxarifado_id' => 'sometimes|integer|exists:almoxarifados,id',
            'tipo' => 'required|string|max:255',
            'quantidade' => 'sometimes|integer|max:255',
            'motivo' => 'sometimes|string|max:255',
            'observacoes' => 'sometimes|string|max:255'
        ]);

        if($validateData['tipo'] != 'ajuste'){
            return response()->json(['success'=> false, 'message' => 'Para editar uma movimentação, faça um ajuste manual!']);
        }

        $movimentacao = $this->movimentacoesService->atualizarMovimentacao($id, $validateData);

        if($movimentacao){
            return response()->json(['success' => true, 'message' => 'Movimentação atualizada com sucesso!', 'data' => $movimentacao], 200);
        }
        return response()->json(['success' => false, 'message' => 'Erro ao atualizar movimentação!'], 500);
    }

    public function destroy($id){
        $movimentacao = $this->movimentacoesService->deletarMovimentacao($id);

        if($movimentacao){
            return response()->json(['success' => true, 'message' => 'Movimentação deletada com sucesso!'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Erro ao deletar movimentação!'], 500);
    }
}