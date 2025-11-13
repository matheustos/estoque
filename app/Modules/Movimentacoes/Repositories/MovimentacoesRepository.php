<?php

namespace App\Modules\Movimentacoes\Repositories;
use App\Modules\Movimentacoes\Models\Movimentacao;

class MovimentacoesRepository{

    public function all(){
        $movimentacoes = Movimentacao::all();

        return $movimentacoes;
    }

    public function buscar($id){
        $movimentacao = Movimentacao::find($id);

        return $movimentacao;
    }

    public function cadastrar($data){
        $movimentacao = Movimentacao::create($data);

        return $movimentacao;
    }

    public function deletar($id){
        $movimentacao = Movimentacao::find($id);

        if($movimentacao){
            $movimentacao->delete();
            return true;
        }
        return null;
    }

    public function atualizar($id, $data){
        $movimentacao = Movimentacao::find($id);

        if($movimentacao){
            $movimentacao->update($data);
            return $movimentacao;
        }
        return null;
    }
}