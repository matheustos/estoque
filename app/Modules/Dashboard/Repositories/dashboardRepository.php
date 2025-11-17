<?php

namespace App\Modules\Dashboard\Repositories;
use App\Modules\Estoque\Models\Estoque;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Movimentacoes\Models\Movimentacao;

class DashboardRepository{
    public function produtosGeral(){
        $total = Produto::count();

        return $total;
    }

    public function falta(){
        $total = Estoque::where('quantidade', 0)->count();

        return $total;
    }

    public function movimentacoes($inicio, $fim){
        $movimentacao = Movimentacao::whereBetween('data_movimentacao', [$inicio, $fim])->count();

        return $movimentacao;
    }

    public function alertas(){
        $alertas = Estoque::whereColumn('quantidade', '<', 'quantidade_minima')->get();

        return $alertas;
    }
}