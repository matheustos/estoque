<?php

namespace App\Modules\Categorias\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Empresas\Models\Empresa;
use Carbon\Carbon;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'empresa_id',
        'nome'
    ];

    protected $hidden = [
        'empresa_id',
        'empresa'
    ];

    protected $appends = [
        'empresa_nome'
    ];

    /**
     * Relacionamento: Categoria pertence a uma Empresa
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function getEmpresaNomeAttribute()
    {
        return $this->empresa->nome ?? null;
    }


    /**
     * Relacionamento: Categoria tem muitos produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

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
