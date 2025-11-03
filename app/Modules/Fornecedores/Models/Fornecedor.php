<?php

namespace App\Modules\Fornecedores\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cidade',
        'compras',
        'status'
    ];
}
