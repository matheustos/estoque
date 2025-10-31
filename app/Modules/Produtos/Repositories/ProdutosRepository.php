<?php

namespace App\Modules\Produtos\Repositories;
use App\Modules\Produtos\Models\Produto;

class ProdutosRepository
{
    public function all()
    {
        return Produto::all();
    }

    public function find($id)
    {
        return Produto::find($id);
    }

    public function create(array $data)
    {
        return Produto::create($data);
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