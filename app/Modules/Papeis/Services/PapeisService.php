<?php

namespace App\Modules\Papeis\Services;
use App\Modules\Papeis\Repositories\PapeisRepository;

class PapeisService
{
    protected $papeisRepository;

    public function __construct(PapeisRepository $papeisRepository)
    {
        $this->papeisRepository = $papeisRepository;
    }

    public function criarPapel($data)
    {
        return $this->papeisRepository->criarPapel($data);
    }
}