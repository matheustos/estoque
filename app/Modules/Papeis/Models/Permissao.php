<?php

namespace App\Modules\Papeis\Models;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';

    protected $fillable = [
        'nome',
        'descricao'
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];

    public function papeis()
    {
        return $this->belongsToMany(Papel::class, 'papel_permissao', 'permissao_id', 'papel_id');
    }

    public $timestamps = false;
}