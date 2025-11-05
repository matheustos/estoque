<?php

namespace App\Modules\Empresas\Repositories;
use App\Modules\Empresas\Models\Empresa;

class EmpresasRepository{
    
    public function cadastrar(array $data){
        $empresa = Empresa::create($data);
        return $empresa;
    }

    public function all(){
        $empresas = Empresa::all();

        return $empresas;
    }

    public function find($id){
        $empresa = Empresa::find($id);

        return $empresa;
    }

    public function updateEmpresa($id, $data){
        $empresa = Empresa::find($id);
        if($empresa){
            $empresa->update($data);
            return $empresa;
        }
        return null;
    }

    public function delete($id){
        $empresa = Empresa::find($id);

        if($empresa){
            $empresa->delete();
            return true;
        }
        return null;
    }
}