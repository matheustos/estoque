<?php

namespace App\Modules\Estoque\Models;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Almoxarifados\Models\Almoxarifado;

class Estoque extends Model{
    protected $table = 'estoque';

    protected $fillable = [
        'produto_id',
        'almoxarifado_id',
        'quantidade',
        'ultima_atualizacao', 
        'quantidade_minima'
    ];

    protected $hidden = [
        'produto_id',
        'produto',
        'almoxarifado_id',
        'almoxarifado'
    ];

    protected $appends = [
        'produto_nome',
        'almoxarifado_nome',
        'categoria_nome',
        'fornecedor_nome',
        'preco_custo',
        'preco_venda'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function almoxarifado()
    {
        return $this->belongsTo(Almoxarifado::class);
    }

    // NOME DO PRODUTO
    public function getProdutoNomeAttribute()
    {
        return $this->produto?->nome;
    }

    // NOME DA CATEGORIA
    public function getCategoriaNomeAttribute()
    {
        return $this->produto?->categoria?->nome;
    }

    // NOME DO FORNECEDOR
    public function getFornecedorNomeAttribute()
    {
        return $this->produto?->fornecedor?->nome;
    }

    // PREÇO DE CUSTO
    public function getPrecoCustoAttribute()
    {
        return $this->produto?->preco_custo;
    }

    // PREÇO DE VENDA
    public function getPrecoVendaAttribute()
    {
        return $this->produto?->preco_venda;
    }

    // NOME DO ALMOXARIFADO
    public function getAlmoxarifadoNomeAttribute()
    {
        return $this->almoxarifado?->nome;
    }

    public $timestamps = false;
}
