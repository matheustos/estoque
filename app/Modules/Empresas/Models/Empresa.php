<?php

namespace App\Modules\Empresas\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Usuarios\Models\Usuario;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nome',
        'data_criacao'
    ];

    /**
     * Relacionamento: Empresa tem muitos produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    /**
     * Relacionamento: Empresa tem muitos usuários
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
