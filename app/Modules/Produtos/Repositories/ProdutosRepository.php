<?php

namespace App\Modules\Produtos\Repositories;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Estoque\Models\Estoque;

class ProdutosRepository
{
    public function all()
    {
        return Produto::with(['empresa', 'categoria', 'fornecedor'])->get();
    }

    public function find($id)
    {
        return Produto::with(['empresa', 'categoria', 'fornecedor'])->find($id);
    }

    public function create(array $data)
    {
        return Produto::create($data);
    }

    public function filtrarProdutosGeral(){
        $total = Produto::count();

        return $total;
    }

    public function filtrarFalta(){
        $total = Estoque::where('quantidade', 0)->count();

        return $total;
    }

    public function update($id, array $data)
    {
        $produto = Produto::find($id);
        if ($produto) {
            $produto->update($data);
            return $produto;
        }
        return null;
    }

    public function delete($id)
    {
        $produto = Produto::find($id);
        if ($produto) {
            return $produto->delete();
        }
        return null;
    }
}