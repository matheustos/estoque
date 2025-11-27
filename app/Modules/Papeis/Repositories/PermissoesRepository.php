<?php

namespace App\Modules\Papeis\Repositories;
use App\Modules\Papeis\Models\Permissao;

class PermissoesRepository{
    public function getAll()
    {
        return Permissao::all();
    }
}