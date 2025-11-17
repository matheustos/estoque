<?php

namespace App\Modules\Dashboard\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Services\DashboardService;

class DashboardController extends Controller{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService){
        $this->dashboardService = $dashboardService;
    }

    public function quantidadeProdutos(){
        $produtosGeral = $this->dashboardService->todosProdutos();
        $produtosFalta = $this->dashboardService->produtosFalta();
        $movimentacoeSemana = $this->dashboardService->movimentacoesSemana();

        return response()->json(['success' => true, 'total_produtos' => $produtosGeral, 'produtos_falta' => $produtosFalta, 'movimentacoes_semana' => $movimentacoeSemana],200);
    }

    public function alertasEstoqueGeral(){
        $alertas = $this->dashboardService->alertasEstoque();

        if($alertas){
            return response()->json(['success' => true, 'message' => 'Alertas encontrados', 'data' => $alertas], 200);
        }
        return response()->json(['success' => false, 'message' => 'Nenhum alerta de estoque no momento!'], 404);
    }
}