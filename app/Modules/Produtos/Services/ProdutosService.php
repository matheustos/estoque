<?php

namespace App\Modules\Produtos\Services;
use App\Modules\Produtos\Repositories\ProdutosRepository;

class ProdutosService
{
    protected $produtosRepository;
    public function __construct(ProdutosRepository $produtosRepository)
    {
        $this->produtosRepository = $produtosRepository;
    }

    public function criarProduto(array $data)
    {
        $produto = $this->produtosRepository->create($data);
        if($produto){
            return $produto;
        }
        return null;
    }

    public function getAllProdutos()
    {
        $produtos = $this->produtosRepository->all();
        if($produtos->isEmpty()){
            return null;
        }
        return $produtos;
    }

    public function getProduto($id){
        $produto = $this->produtosRepository->find($id);
        if(!$produto){
            return null;
        }
        return $produto;
    }

    public function updateProduto($data, $id){
        $produto = $this->produtosRepository->update($id, $data);
        
        if($produto){
            return $produto;
        }
        return null;
    }

    public function deleteProduto($id){
        $deleted = $this->produtosRepository->delete($id);
        if($deleted){
            return true;
        }
        return null;
    }
}