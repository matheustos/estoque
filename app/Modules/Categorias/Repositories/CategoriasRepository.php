<?php

namespace App\Modules\Categorias\Repositories;
use App\Modules\Categorias\Models\Categoria;

class CategoriasRepository{
    
    public function cadastrar($data){
        $categoria = Categoria::create($data);

        return $categoria;
    }

    public function all(){
        $categoria = Categoria::with(['empresa'])->get();

        return $categoria;
    }

    public function find($id){
        $categoria = Categoria::with(['empresa'])->find($id);

        return $categoria;
    }
    
    public function atualizar($data, $id){
        $categoria = Categoria::find($id);
        if($categoria){
            $categoria->update($data);
            return $categoria;
        }
        return null;
    }

    public function delete($id){
        $categoria = Categoria::find($id);
        if($categoria){
            $categoria->delete();
            return true;
        }
        return null;
    }
}