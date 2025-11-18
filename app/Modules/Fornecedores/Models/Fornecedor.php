<?php

namespace App\Modules\Fornecedores\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cidade',
        'compras',
        'status',
        'favorito'
    ];

    protected $casts = [
        'status' => 'boolean',
        'favorito' => 'boolean',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)
            ->timezone('America/Sao_Paulo')
            ->format('Y-m-d H:i:s');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)
            ->timezone('America/Sao_Paulo')
            ->format('Y-m-d H:i:s');
    }
}
