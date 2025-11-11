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
        'ultima_atualizacao'
    ];

    protected $hidden = [
        'produto_id',
        'produto',
        'almoxarifado_id',
        'almoxarifado'
    ];

    protected $appends = ['produto_nome', 'almoxarifado_nome'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function almoxarifado()
    {
        return $this->belongsTo(Almoxarifado::class);
    }

    public function getProdutoNomeAttribute()
    {
        return $this->produto->nome ?? null;
    }

    public function getAlmoxarifadoNomeAttribute()
    {
        return $this->almoxarifado->nome ?? null;
    }
}