<?php

namespace App\Modules\Papeis\Services;
use App\Modules\Papeis\Repositories\PapeisRepository;

class PapeisPermissoesService
{
    protected $papeisRepository;

    public function __construct(PapeisRepository $papeisRepository)
    {
        $this->papeisRepository = $papeisRepository;
    }

    public function atribuirPermissoesAoPapel($data)
    {
        $papel = $this->papeisRepository->obterPapelPorId($data['papel_id']);
        if (!$papel) {
            return false; // Papel não encontrado
        }

        $papel->permissoes()->sync($data['permissao_id']);
        return $papel->permissoes;
    }
}