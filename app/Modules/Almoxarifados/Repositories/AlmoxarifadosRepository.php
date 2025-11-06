<?php

namespace App\Modules\Almoxarifados\Repositories;
use App\Modules\Almoxarifados\Models\Almoxarifado;

class AlmoxarifadosRepository{

    public function cadastrar(array $data){
        $almoxarifado = Almoxarifado::create($data);

        return $almoxarifado;
    }

    public function all(){
        $almoxarifados = Almoxarifado::with(['empresa'])->get();

        return $almoxarifados;
    }

    public function find($id){
        $almoxarifado = Almoxarifado::with(['empresa'])->find($id);

        return $almoxarifado;
    }

    public function updateAlmoxarifado($data, $id){
        $almoxarifado = Almoxarifado::find($id);
        if ($almoxarifado) {
            $almoxarifado->update($data);
            return $almoxarifado;
        }
        return null;
    }

    public function delete($id){
        $almoxarifado = Almoxarifado::find($id);
        if($almoxarifado){
            $almoxarifado->delete();
            return true;
        }
        return null;
    }
}