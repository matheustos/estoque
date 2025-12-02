<?php

namespace App\Modules\Produtos\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Produtos\Services\ProdutosService;
use App\Modules\Estoque\Services\EstoquesService;
use App\Retorno\Retorno;

class ProdutosController extends Controller
{
    protected $produtosService;
    protected $estoquesService;

    public function __construct(ProdutosService $produtosService, EstoquesService $estoquesService)
    {
        $this->produtosService = $produtosService;
        $this->estoquesService = $estoquesService;
    }
    public function index()
    {
        $produtos = $this->produtosService->getAllProdutos();
        if(!$produtos) {
            return Retorno::erro('Nenhum produto encontrado', 404);
        }
        return Retorno::sucesso('Produtos encontrados com sucesso', $produtos, 200);
    }

    public function show($id)
    {
        $produtos = $this->produtosService->getProduto($id);
        if(!$produtos) {
            return Retorno::erro('Produto não encontrado', 404);
        }
        return Retorno::sucesso('Produto encontrado com sucesso', $produtos, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'empresa_id' => 'required|integer|exists:empresas,id',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'nome' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:produtos,sku',
            'descricao' => 'nullable|string',
            'preco_custo' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'fornecedor_id' => 'required|integer|exists:fornecedores,id',
            'almoxarifado_id' => 'required|integer|exists:almoxarifados,id',
            'quantidade' =>'required|integer|max:100',
            'quantidade_minima' =>'required|integer|max:100'
        ]);

        $produto = $this->produtosService->criarProduto($validatedData);

        if($produto) {
            $data = [];
            date_default_timezone_set('America/Sao_Paulo'); // define o fuso horário
            $dataHora = date('Y-m-d H:i:s'); // formato: 2025-11-11 11:30:45
            $data['ultima_atualizacao'] = $dataHora;
            $data['produto_id'] = $produto->id;
            $data['almoxarifado_id'] = $validatedData['almoxarifado_id'];
            $data['quantidade'] = $validatedData['quantidade'];
            $data['quantidade_minima'] = $validatedData['quantidade_minima'];
            $this->estoquesService->cadastrarEstoque($data);
            return Retorno::sucesso('Produto criado com sucesso', $produto, 200);
        } else {
            return Retorno::erro('Erro ao criar produto', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'empresa_id' => 'sometimes|integer|exists:empresas,id',
            'categoria_id' => 'sometimes|integer|exists:categorias,id',
            'fornecedor_id' => 'sometimes|integer|exists:fornecedores,id',
            'nome' => 'sometimes|string|max:255',
            'sku' => 'sometimes|string|max:100|unique:produtos,sku',
            'descricao' => 'nullable|string',
            'preco_custo' => 'sometimes|numeric|min:0',
            'preco_venda' => 'sometimes|numeric|min:0'
        ]);

        $produto = $this->produtosService->updateProduto($validatedData, $id);

        if($produto){
            return Retorno::sucesso('Produto atualizado com sucesso', $produto, 200);
        }
        return Retorno::erro('Produto não encontrado', 404);

    }

    public function destroy($id)
    {
        $produto = $this->produtosService->deleteProduto($id);
        if($produto){
            return Retorno::sucesso('Produto deletado com sucesso', null, 200);
        }
        return Retorno::erro('Produto não encontrado', 404);
    }

    public function filtrarQuantidadeProdutos(){
        $total = $this->produtosService->filtrarProdutos();
        if($total){
            return Retorno::sucesso('Total de produtos obtido com sucesso', ['total_produtos' => $total], 200);
        }
        return Retorno::erro('Erro ao obter total de produtos', 500);
    }

    public function buscarFaltaProdutos(){
        $total = $this->produtosService->filtrarFaltaProdutos();
        if($total){
            return Retorno::sucesso('Total de produtos em falta obtido com sucesso', ['total_produtos_falta' => $total], 200);
        }
        return Retorno::erro('Erro ao obter total de produtos em falta', 500);
    }
}