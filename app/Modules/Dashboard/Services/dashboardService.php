<?php

namespace App\Modules\Dashboard\Services;
use App\Modules\Dashboard\Repositories\DashboardRepository;
use Carbon\Carbon;

class DashboardService{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository){
        $this->dashboardRepository = $dashboardRepository;
    }

    public function filtrarDadosCards(){
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $fimSemana = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $movimentacoes = $this->dashboardRepository->filtrarMovimentacoes($inicioSemana, $fimSemana);
        $produtosFalta = $this->dashboardRepository->filtrarFalta();
        $totalProdutos = $this->dashboardRepository->filtrarProdutosGeral();

        return [
            'total_produtos' => $totalProdutos,
            'produtos_falta' => $produtosFalta,
            'movimentacoes_semana' => $movimentacoes
        ];
    }

    public function alertasEstoque(){
        $alertas = $this->dashboardRepository->alertas();

        if($alertas){
            return $alertas;
        }
        return null;
    }
}