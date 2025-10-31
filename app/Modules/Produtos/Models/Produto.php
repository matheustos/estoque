<?php

namespace App\Modules\Produtos\Models;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'nome',
        'sku',
        'descricao',
        'preco_custo',
        'preco_venda'
    ];
}