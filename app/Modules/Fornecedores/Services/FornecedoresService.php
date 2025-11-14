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

    public function todosFornecedores(){
        $fornecedores = $this->fornecedoresRepository->fornecedoresGeral();

        return $fornecedores;
    }

    public function fornecedoresAtivo(){
        $fornecedores = $this->fornecedoresRepository->ativos();

        return $fornecedores;
    }

    public function fornecedoresInativo(){
        $fornecedores = $this->fornecedoresRepository->inativos();

        return $fornecedores;
    }

    public function fornecedoresFavoritos(){
        $fornecedores = $this->fornecedoresRepository->favoritos();

        return $fornecedores;
    }

    public function updateFornecedor($data, $id){
        $fornecedor = $this->fornecedoresRepository->atualizaFornecedor($data, $id);

        if($fornecedor){
            return $fornecedor;
        }
        return null;
    }

    public function deleteFornecedor($id){
        $fornecedor = $this->fornecedoresRepository->delete($id);

        if(!$fornecedor){
            return null;
        }
        return true;
    }
}