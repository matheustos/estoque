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
}