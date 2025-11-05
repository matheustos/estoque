<?php

namespace App\Modules\Empresas\Services;
use App\Modules\Empresas\Repositories\EmpresasRepository;

class EmpresasService{
    protected $empresasRepository;
    public function __construct(EmpresasRepository $empresasRepository){
        $this->empresasRepository = $empresasRepository;
    }

    public function cadastrarEmpresa(array $data){
        $empresa = $this->empresasRepository->cadastrar($data);

        if($empresa){
            return $empresa;
        }
        return null;
    }

    public function buscarTodas(){
        $empresas = $this->empresasRepository->all();

        if($empresas){
            return $empresas;
        }
        return null;
    }

    public function buscarPorId($id){
        $empresa = $this->empresasRepository->find($id);

        if($empresa){
            return $empresa;
        }
        return null;
    }

    public function atualizarEmpresa($id, $data){
        $empresa = $this->empresasRepository->updateEmpresa($id, $data);

        if($empresa){
            return $empresa;
        }
        return null;
    }

    public function deletarEmpresa($id){
        $empresa = $this->empresasRepository->delete($id);

        if($empresa){
            return $empresa;
        }
        return null;
    }
}