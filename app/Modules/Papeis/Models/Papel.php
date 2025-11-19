<?php

namespace App\Modules\Papeis\Models;
use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    protected $table = 'papeis';

    protected $fillable = [
        'empresa_id',
        'nome',
        'descricao'
    ];

    public function usuarios()
    {
        return $this->hasMany(\App\Modules\Usuarios\Models\Usuario::class, 'papel_id');
    }
}