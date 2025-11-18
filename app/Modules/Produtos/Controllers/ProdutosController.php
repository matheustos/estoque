<?php

namespace App\Modules\Produtos\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Produtos\Services\ProdutosService;
use App\Modules\Estoque\Services\EstoquesService;

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
            return response()->json(['success' => false, 'message' => 'Nenhum produto encontrado'], 404);
        }
        return response()->json(['success' => true, 'message' => 'Produtos encontrados:', 'produtos'=> $produtos]);
    }

    public function show($id)
    {
        $produtos = $this->produtosService->getProduto($id);
        if(!$produtos) {
            return response()->json(['success' => false, 'message' => 'Nenhum produto encontrado'], 404);
        }
        return response()->json(['success' => true, 'message' => 'Produto encontrado:', 'produto'=> $produtos]);
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
            return response()->json(['success' => true, 'message' => 'Produto criado com sucesso', 'produto' => $produto], 201);
        } else {
            return response()->json(['success' => false, 'message' => 'Erro ao criar produto'], 500);
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
            return response()->json(['success' => true, 'message' => 'Produto atualizado com sucesso!', 'produto' => $produto]);
        }
        return response()->json(['success' => false, 'message' => 'Produto não encontrado!']);

    }

    public function destroy($id)
    {
        $produto = $this->produtosService->deleteProduto($id);
        if($produto){
            return response()->json(['success' => true, 'message' => 'Produto deletado com sucesso!']);
        }
        return response()->json(['success' => false, 'message' => 'Produto não encontrado!']);
    }
}