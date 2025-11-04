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
}