<?php

namespace App\Modules\Papeis\Services;
use App\Modules\Papeis\Repositories\PermissoesRepository;

class PermissoesService{
    
    protected $permissoesRepository;

    public function __construct(PermissoesRepository $permissoesRepository)
    {
        $this->permissoesRepository = $permissoesRepository;
    }

    public function getAllPermissoes()
    {
        return $this->permissoesRepository->getAll();
    }

}