<?php

namespace App\Modules\Categorias\Services;
use App\Modules\Categorias\Repositories\CategoriasRepository;

class CategoriasService{
    protected $categoriasRepository;

    public function __construct(CategoriasRepository $categoriasRepository){
        $this->categoriasRepository = $categoriasRepository;
    }

    public function cadastrarCategoria(array $data){
        $categoria = $this->categoriasRepository->cadastrar($data);

        if($categoria){
            return $categoria;
        }
        return null;
    }

    public function buscarTodos(){
        $categorias = $this->categoriasRepository->all();

        if($categorias){
            return $categorias;
        }
        return null;
    }

    public function buscar($id){
        $categoria = $this->categoriasRepository->find($id);

        if($categoria){
            return $categoria;
        }
        return null;
    }

    public function atualizarCategoria($data, $id){
        $categoria = $this->categoriasRepository->atualizar($data, $id);

        if($categoria){
            return $categoria;
        }
        return null;
    }

    public function deletarCategoria($id){
        $categoria = $this->categoriasRepository->delete($id);

        if($categoria){
            return $categoria;
        }
        return null;
    }
}