<?php

namespace App\Modules\Movimentacoes\Repositories;
use App\Modules\Movimentacoes\Models\Movimentacao;

class MovimentacoesRepository{
    public function cadastrar($data){
        $movimentacao = Movimentacao::create($data);

        return $movimentacao;
    }
}