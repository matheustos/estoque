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

    public function filtrarTodosFornecedores(){
        $fornecedoresGeral = $this->fornecedoresRepository->filtrarFornecedoresGeral();
        $fornecedoresAtivo = $this->fornecedoresRepository->filtrarAtivos();
        $fornecedoresInativo = $this->fornecedoresRepository->filtrarInativos();
        $fornecedoresFavoritos = $this->fornecedoresRepository->filtrarFavoritos();

        return [
            'total_fornecedores' => $fornecedoresGeral,
            'fornecedores_ativos' => $fornecedoresAtivo,
            'fornecedores_inativos' => $fornecedoresInativo,
            'fornecedores_favoritos' => $fornecedoresFavoritos
        ];
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