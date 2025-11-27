<?php

namespace App\Modules\Papeis\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Papeis\Services\PermissoesService;
use App\Retorno\Retorno;

class PermissoesController extends Controller
{
    protected $permissoesService;

    public function __construct(PermissoesService $permissoesService)
    {
        $this->permissoesService = $permissoesService;
    }

    public function index()
    {
        $permissoes = $this->permissoesService->getAllPermissoes();
        return Retorno::sucesso('Permissões encontradas', $permissoes, 200);
    }
}