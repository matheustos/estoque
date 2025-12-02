<?php

namespace App\Modules\Movimentacoes\Controllers;
use App\Modules\Movimentacoes\Services\MovimentacoesService;
use App\Retorno\Retorno;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Modules\Estoque\Models\Estoque;

class MovimentacoesController{
    protected $movimentacoesService;

    public function __construct(MovimentacoesService $movimentacoesService){
        $this->movimentacoesService = $movimentacoesService;
    }

    public function index(){
        $movimentacoes = $this->movimentacoesService->buscarTodos();

        if($movimentacoes){
            return Retorno::sucesso('Movimentações encontradas com sucesso!', $movimentacoes, 200);
        }
        return Retorno::erro('Nenhuma movimentação encontrada!', 404);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'produto_id' => 'required|integer|exists:produtos,id',
            'almoxarifado_id' => 'required|integer|exists:almoxarifados,id',
            'fornecedor_id' => 'required|integer|exists:fornecedores,id',
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
            return Retorno::erro('A quantidade não pode ser superior ao estoque!', 500);
        }

        if($validateData['quantidade'] <= 0){
            return Retorno::erro('A quantidade deve ser maior que zero!', 500);
        }
        $usuarioId = JWTAuth::user()->id;
        $validateData['usuario_id'] = $usuarioId;

        if($validateData['tipo'] === 'entrada'){
            $movimentacao = $this->movimentacoesService->registrarEntrada($validateData);
            if($movimentacao){
                return Retorno::sucesso('Movimentação registrada com sucesso!', $movimentacao, 200);
            }
        }

        if($validateData['tipo'] === 'saida'){
            $movimentacao = $this->movimentacoesService->registrarSaida($validateData);
            if($movimentacao){
                return Retorno::sucesso('Movimentação registrada com sucesso!', $movimentacao, 200);
            }
        }

        return Retorno::erro('Erro ao registrar movimentação!', 500);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'produto_id' => 'required|integer|exists:produtos,id',
            'almoxarifado_id' => 'sometimes|integer|exists:almoxarifados,id',
            'tipo' => 'required|string|max:255',
            'quantidade' => 'sometimes|integer|max:255',
            'motivo' => 'sometimes|string|max:255',
            'observacoes' => 'sometimes|string|max:255'
        ]);

        if($validateData['tipo'] != 'ajuste'){
            return Retorno::erro('Apenas movimentações do tipo ajuste podem ser atualizadas!', 500);
        }

        $estoque = Estoque::where('produto_id', $validateData['produto_id'] ?? null)
            ->lockForUpdate()
            ->first();
        $saldo = $estoque->quantidade;

        // se quantidade da movimentação for negativa
        if($validateData['quantidade'] < 0){
            // verifica se a diferença do saldo atual e a quantidade que saiu é menor que zero
            if($saldo + $validateData['quantidade'] < 0){
                return Retorno::erro('A quantidade não pode ser superior ao estoque!', 500);
            }
        }
        $usuarioId = JWTAuth::user()->id;
        $validateData['usuario_id'] = $usuarioId;

        $movimentacao = $this->movimentacoesService->atualizarMovimentacao($id, $validateData);

        if($movimentacao){
            return Retorno::sucesso('Movimentação atualizada com sucesso!', $movimentacao, 200);
        }
        return Retorno::erro('Erro ao atualizar movimentação!', 500);
    }

    public function destroy($id){
        $movimentacao = $this->movimentacoesService->deletarMovimentacao($id);

        if($movimentacao){
            return Retorno::sucesso('Movimentação deletada com sucesso!', null, 200);
        }
        return Retorno::erro('Erro ao deletar movimentação!', 500);
    }

    public function buscarMovimentacoesSemana(){
        $movimentacoes = $this->movimentacoesService->buscarMovimentacoesPorIntervalo();

        if($movimentacoes){
            return Retorno::sucesso('Movimentações da semana encontradas com sucesso!', $movimentacoes, 200);
        }
        return Retorno::erro('Nenhuma movimentação encontrada na semana!', 404);
    }
}