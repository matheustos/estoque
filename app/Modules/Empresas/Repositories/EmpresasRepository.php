<?php

namespace App\Modules\Empresas\Repositories;
use App\Modules\Empresas\Models\Empresa;

class EmpresasRepository{
    
    public function cadastrar(array $data){
        $empresa = Empresa::create($data);
        return $empresa;
    }
}