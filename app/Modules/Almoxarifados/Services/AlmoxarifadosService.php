<?php 

namespace App\Modules\Almoxarifados\Services;
use App\Modules\Almoxarifados\Repositories\AlmoxarifadosRepository;

class AlmoxarifadosService{
    
    protected $almoxarifadosRepository;

    public function __construct(AlmoxarifadosRepository $almoxarifadosRepository){
        $this->almoxarifadosRepository = $almoxarifadosRepository;
    }

    public function cadastrarAlmoxarifado(array $data){
        $almoxarifado = $this->almoxarifadosRepository->cadastrar($data);

        if($almoxarifado){
            return $almoxarifado;
        }
        return null;
    }

    public function buscarTodos(){
        $almoxarifados = $this->almoxarifadosRepository->all();

        if($almoxarifados){
            return $almoxarifados;
        }
        return null;
    }

    public function buscarPorId($id){
        $almoxarifado = $this->almoxarifadosRepository->find($id);

        if($almoxarifado){
            return $almoxarifado;
        }
        return null;
    }

    public function atualizarAlmoxarifado($data, $id){
        $almoxarifado = $this->almoxarifadosRepository->updateAlmoxarifado($data, $id);

        if($almoxarifado){
            return $almoxarifado;
        }
        return null;
    }

    public function deleteAlmoxarifado($id){
        $deleted = $this->almoxarifadosRepository->delete($id);
        if($deleted){
            return true;
        }
        return null;
    }
}