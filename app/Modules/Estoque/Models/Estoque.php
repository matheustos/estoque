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
        'almoxarifado',
        'ultima_atualizacao'
    ];

    protected $appends = [
        'produto_nome',
        'produto_sku',
        'almoxarifado_nome',
        'categoria_nome',
        'fornecedor_nome',
        'preco_custo',
        'preco_venda',
        'status'
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

    public function getProdutoSkuAttribute()
    {
        return $this->produto?->sku;
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

    // ACESSOR DE STATUS
    public function getStatusAttribute()
    {
        if ($this->quantidade < $this->quantidade_minima) {
            return 'Estoque baixo';
        }

        return 'Normal';
    }

    public $timestamps = false;
}
