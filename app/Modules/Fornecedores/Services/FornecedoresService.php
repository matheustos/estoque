<?php

namespace App\Modules\Fornecedores\Services;
use App\Modules\Fornecedores\Repositories\FornecedoresRepository;

class FornecedoresService{
    protected $fornecedoresRepository;

    public function __construct(FornecedoresRepository $fornecedoresRepository)
    {
        $this->fornecedoresRepository = $fornecedoresRepository;
    }

    public function cadastrarForncedores(array $data){
        $fornecedor = $this->fornecedoresRepository->cadastrar($data);

        if($fornecedor){
            return $fornecedor;
        }
        return null;
    }

    public function buscarFornecedor($id){
        $fornecedor = $this->fornecedoresRepository->buscar($id);

        if($fornecedor){
            return $fornecedor;
        }
        return null;
    }

    public function buscarTodosFornecedores(){
        $fornecedores = $this->fornecedoresRepository->all();

        if($fornecedores){
            return $fornecedores;
        }
        return null;
    }
}