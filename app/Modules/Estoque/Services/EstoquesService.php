<?php

namespace App\Modules\Estoque\Services;
use App\Modules\Estoque\Repositories\EstoquesRepository;

class EstoquesService{
    protected $estoquesRepository;

    public function __construct(EstoquesRepository $estoquesRepository){
        $this->estoquesRepository = $estoquesRepository;
    }

    public function cadastrarEstoque(array $data){
        $estoque = $this->estoquesRepository->cadastrar($data);

        if($estoque){
            return $estoque;
        }
        return null;
    }

    public function buscarTodos(){
        $estoques = $this->estoquesRepository->all();

        if($estoques){
            return $estoques;
        }
        return null;
    }

    public function buscarPorId($id){
        $estoque = $this->estoquesRepository->buscar($id);

        if($estoque){
            return $estoque;
        }
        return null;
    }

    public function atualizarEstoque($data, $id){
        $estoque = $this->estoquesRepository->atualizar($data, $id);

        if($estoque){
            return $estoque;
        }
        return null;
    }

    public function deletarEstoque($id){
        $estoque = $this->estoquesRepository->delete($id);

        if($estoque){
            return $estoque;
        }
        return null;
    }

    public function alertasEstoque(){
        $alertas = $this->estoquesRepository->alertas();

        if($alertas){
            return $alertas;
        }
        return null;
    }
}