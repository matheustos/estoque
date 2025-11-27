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

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function usuarios()
    {
        return $this->hasMany(\App\Modules\Usuarios\Models\Usuario::class, 'papel_id');
    }

    public function permissoes()
    {
        return $this->belongsToMany(
            Permissao::class,            // model relacionado
            'papel_permissoes',          // nome da tabela pivot
            'papel_id',                  // chave estrangeira da tabela atual
            'permissao_id'               // chave estrangeira da outra tabela
        );
    }

    public $timestamps = false;
}