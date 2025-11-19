<?php

namespace App\Modules\Papeis\Repositories;
use App\Modules\Papeis\Models\Papel;

class PapeisRepository
{
    public function criarPapel($data)
    {
        return Papel::create($data);
    }
}