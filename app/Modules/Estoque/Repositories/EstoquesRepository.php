<?php

namespace App\Modules\Estoque\Repositories;
use App\Modules\Estoque\Models\Estoque;

class EstoquesRepository{
    public function cadastrar(array $data){
        $estoque = Estoque::create($data);

        return $estoque;
    }

    public function all(){
        $estoques = Estoque::all();

        return $estoques;
    }

    public function buscar($id){
        $estoque = Estoque::find($id);

        return $estoque;
    }

    public function atualizar($data, $id){
        $estoque = Estoque::find($id);
        $estoque->update($data);

        return $estoque;
    }

    public function delete($id){
        $estoque = Estoque::find($id);
        $estoque->delete();

        return true;
    }

    public function alertas(){
        $alertas = Estoque::whereColumn('quantidade', '<', 'quantidade_minima')->get();

        return $alertas;
    }
}