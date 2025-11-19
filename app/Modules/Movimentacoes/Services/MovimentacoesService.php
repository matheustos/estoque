<?php

namespace App\Modules\Movimentacoes\Services;
use App\Modules\Movimentacoes\Repositories\MovimentacoesRepository;
use App\Modules\Estoque\Models\Estoque;
use App\Modules\Fornecedores\Models\Fornecedor;

class MovimentacoesService{
    protected $movimentacoesRepository;

    public function __construct(MovimentacoesRepository $movimentacoesRepository){
        $this->movimentacoesRepository = $movimentacoesRepository;
    }

    public function buscarTodos(){
        $movimentacoes = $this->movimentacoesRepository->all();

        if($movimentacoes){
            return $movimentacoes;
        }
        return null;
    }

    public function buscarPorId($id){
        $movimentacao = $this->movimentacoesRepository->buscar($id);

        if($movimentacao){
            return $movimentacao;
        }
        return null;
    }

    public function registrarEntrada(array $data){
        $estoque = Estoque::where('produto_id', $data['produto_id'] ?? null)
            ->lockForUpdate()
            ->first();
        $saldoAntes = $estoque->quantidade;
        if($data['tipo'] === 'entrada'){
            $saldoDepois = $saldoAntes + $data['quantidade'];
            $estoque->update(['quantidade' => $saldoDepois]);
            // se for entrada, atualiza o campo compras do fornecedor
            $fornecedor = Fornecedor::find($data['fornecedor_id'] ?? null);
            if($fornecedor){
                $fornecedor->increment('compras', 1);
            }
        }

        $movimentacao = $this->movimentacoesRepository->cadastrar($data);

        if($movimentacao){
            return $movimentacao;
        }
        return null;
    }

    public function registrarSaida(array $data){
        $estoque = Estoque::where('produto_id', $data['produto_id'] ?? null)
            ->lockForUpdate()
            ->first();
        $saldoAntes = $estoque->quantidade;
        $saldoDepois = $saldoAntes - $data['quantidade'];
        $estoque->update(['quantidade' => $saldoDepois]);

        $movimentacao = $this->movimentacoesRepository->cadastrar($data);

        if($movimentacao){
            return $movimentacao;
        }
        return null;
    }

    public function atualizarMovimentacao($id, $data){
        $estoque = Estoque::where('produto_id', $data['produto_id'] ?? null)
            ->lockForUpdate()
            ->first();
        $saldoAntes = $estoque->quantidade;
        $saldoDepois = $saldoAntes + $data['quantidade'];
        $estoque->update([
            'quantidade' => $saldoDepois,
        ]);
        $movimentacao = $this->movimentacoesRepository->atualizar($id, $data);

        if($movimentacao){
            return $movimentacao;
        }
        return null;
    }
    public function deletarMovimentacao($id){
        $movimentacao = $this->movimentacoesRepository->deletar($id);

        if($movimentacao){
            return $movimentacao;
        }
        return null;
    }
}