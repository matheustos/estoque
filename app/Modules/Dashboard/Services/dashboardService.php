<?php

namespace App\Modules\Dashboard\Services;
use App\Modules\Dashboard\Repositories\DashboardRepository;
use Carbon\Carbon;

class DashboardService{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository){
        $this->dashboardRepository = $dashboardRepository;
    }

    public function todosProdutos(){
        $produtos = $this->dashboardRepository->produtosGeral();

        return $produtos;
    }

    public function produtosFalta(){
        $produtos = $this->dashboardRepository->falta();

        return $produtos;
    }

    public function movimentacoesSemana(){
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $fimSemana = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $movimentacoes = $this->dashboardRepository->movimentacoes($inicioSemana, $fimSemana);
        if($movimentacoes){
            return $movimentacoes;
        }
        return null;
    }

    public function alertasEstoque(){
        $alertas = $this->dashboardRepository->alertas();

        if($alertas){
            return $alertas;
        }
        return null;
    }
}