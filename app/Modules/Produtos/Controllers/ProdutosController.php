<?php

namespace App\Modules\Produtos\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Produtos\Services\ProdutosService;

class ProdutosController extends Controller
{
    protected $produtosService;

    public function __construct(ProdutosService $produtosService)
    {
        $this->produtosService = $produtosService;
    }
    public function index()
    {
        $produtos = $this->produtosService->getAllProdutos();
        if(!$produtos) {
            return response()->json(['message' => 'Nenhum produto encontrado'], 404);
        }
        return response()->json(['message' => 'Produtos encontrados:', 'produtos'=> $produtos]);
    }

    public function show($id)
    {
        $produtos = $this->produtosService->getProduto($id);
        if(!$produtos) {
            return response()->json(['message' => 'Nenhum produto encontrado'], 404);
        }
        return response()->json(['message' => 'Produto encontrado:', 'produto'=> $produtos]);
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
        ]);

        $produto = $this->produtosService->criarProduto($validatedData);

        if($produto) {
            return response()->json(['message' => 'Produto criado com sucesso', 'produto' => $produto], 201);
        } else {
            return response()->json(['message' => 'Erro ao criar produto'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'empresa_id' => 'sometimes|integer|exists:empresas,id',
            'categoria_id' => 'sometimes|integer|exists:categorias,id',
            'nome' => 'sometimes|string|max:255',
            'sku' => 'sometimes|string|max:100|unique:produtos,sku',
            'descricao' => 'nullable|string',
            'preco_custo' => 'sometimes|numeric|min:0',
            'preco_venda' => 'sometimes|numeric|min:0'
        ]);

        $produto = $this->produtosService->updateProduto($validatedData, $id);

        if($produto){
            return response()->json(['message' => 'Produto atualizado com sucesso!', 'produto' => $produto]);
        }
        return response()->json(['message' => 'Produto não encontrado!']);

    }

    public function destroy($id)
    {
        $produto = $this->produtosService->deleteProduto($id);
        if($produto){
            return response()->json(['message' => 'Produto deletado com sucesso!']);
        }
        return response()->json(['message' => 'Produto não encontrado!']);
    }
}