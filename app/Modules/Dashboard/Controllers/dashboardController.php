<?php

namespace App\Modules\Dashboard\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Services\DashboardService;
use App\Retorno\Retorno;

class DashboardController extends Controller{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService){
        $this->dashboardService = $dashboardService;
    }

    public function filtrarProdutos(){
        $filtros = $this->dashboardService->filtrarDadosCards();

        return Retorno::sucesso('Dados do dashboard filtrados com sucesso!', $filtros, 200);
    }

    public function alertasEstoqueGeral(){
        $alertas = $this->dashboardService->alertasEstoque();

        if($alertas){
            return Retorno::sucesso('Alertas de estoque encontrados com sucesso!', $alertas, 200);
        }
        return Retorno::erro('Nenhum alerta de estoque encontrado.', 404);
    }
}