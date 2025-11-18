<?php

namespace App\Modules\Almoxarifados\Models;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Empresas\Models\Empresa;
use Carbon\Carbon;

class Almoxarifado extends Model{
    protected $table = 'almoxarifados';

    protected $fillable = [
        'empresa_id',
        'nome',
        'endereco'
    ];

    protected $hidden = [
        'empresa_id',
        'empresa'
    ];

    protected $appends = ['empresa_nome'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function getEmpresaNomeAttribute()
    {
        return $this->empresa->nome ?? null;
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