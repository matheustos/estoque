<?php

namespace App\Modules\Movimentacoes\Models;
use App\Modules\Usuarios\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Almoxarifados\Models\Almoxarifado;

class Movimentacao extends Model{
    protected $table = 'movimentacoes_estoque';

    protected $fillable = [
        'produto_id',
        'almoxarifado_id',
        'tipo',
        'quantidade',
        'usuario_id',
        'data_movimentacao',
        'motivo'
    ];

    protected $hidden = [
        'produto_id',
        'produto',
        'almoxarifado_id',
        'almoxarifado',
        'usuario_id',
        'usuario'
    ];
    protected $appends = ['produto_nome', 'almoxarifado_nome', 'usuario_nome'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function almoxarifado()
    {
        return $this->belongsTo(Almoxarifado::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function getProdutoNomeAttribute()
    {
        return $this->produto->nome ?? null;
    }

    public function getAlmoxarifadoNomeAttribute()
    {
        return $this->almoxarifado->nome ?? null;
    }

    public function getUsuarioNomeAttribute()
    {
        return $this->usuario->nome ?? null;
    }

    public $timestamps = false;

}