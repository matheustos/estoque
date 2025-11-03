<?php

namespace App\Modules\Produtos\Models;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Empresas\Models\Empresa;
use App\Modules\Categorias\Models\Categoria;
use App\Modules\Fornecedores\Models\Fornecedor;

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
        'preco_venda',
        'fornecedor_id'
    ];

    protected $hidden = [
        'empresa_id',
        'categoria_id',
        'fornecedor_id',
        'empresa',
        'categoria',
        'fornecedor'
    ];

    /**
     * Adicionar automaticamente esses campos no JSON
     */
    protected $appends = [
        'empresa_nome',
        'categoria_nome',
        'fornecedor_nome'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * Relacionamento: Produto pertence a uma Categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function getEmpresaNomeAttribute()
    {
        return $this->empresa->nome ?? null;
    }

    public function getCategoriaNomeAttribute()
    {
        return $this->categoria->nome ?? null;
    }

    public function getFornecedorNomeAttribute()
    {
        return $this->fornecedor->nome ?? null;
    }
}