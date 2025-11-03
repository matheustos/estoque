<?php

namespace App\Modules\Categorias\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Empresas\Models\Empresa;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'empresa_id',
        'nome'
    ];

    /**
     * Relacionamento: Categoria pertence a uma Empresa
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * Relacionamento: Categoria tem muitos produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
