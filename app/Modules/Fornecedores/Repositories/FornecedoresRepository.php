<?php

namespace App\Modules\Fornecedores\Repositories;
use App\Modules\Fornecedores\Models\Fornecedor;
class FornecedoresRepository{
    public function cadastrar($data){
        $fornecedor = Fornecedor::create($data);

        return $fornecedor;
    }

    public function all(){
        return Fornecedor::all();
    }

    public function buscar($id){
        return Fornecedor::find($id);
    }

    public function fornecedoresGeral(){
        $total = Fornecedor::count();

        return $total;
    }

    public function ativos(){
        $total = Fornecedor::where('status', true)->count();

        return $total;
    }

    public function inativos(){
        $total = Fornecedor::where('status', false)->count();

        return $total;
    }

    public function favoritos(){
        $total = Fornecedor::where('favorito', true)->count();

        return $total;
    }

    public function atualizaFornecedor($data, $id){
        $fornecedor = Fornecedor::find($id);
        if(!$fornecedor){
            return null;
        }
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function delete($id){
        $fornecedor = Fornecedor::find($id);

        if(!$fornecedor){
            return null;
        }
        $fornecedor->delete();
        return true;
    }
}