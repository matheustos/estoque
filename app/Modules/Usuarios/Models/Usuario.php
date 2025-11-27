<?php

namespace App\Modules\Usuarios\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Carbon\Carbon;
use App\Modules\Papeis\Models\Papel;
use App\Modules\Empresas\Models\Empresa;

class Usuario extends Authenticatable implements JWTSubject
{
    protected $table = 'usuarios';

    protected $fillable = [
        'empresa_id',
        'papel_id',
        'nome',
        'email',
        'password'
    ];

    protected $hidden = ['password', 'empresa', 'papel', 'empresa_id', 'papel_id', 'created_at', 'updated_at'];
    protected $appends = ['papel_nome', 'empresa_nome'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
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

    public function papel()
    {
        return $this->belongsTo(Papel::class, 'papel_id');
    }

    public function hasPermission($permissao_nome)
    {
        return $this->papel
            ->permissoes
            ->contains('nome', $permissao_nome);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function getEmpresaNomeAttribute()
    {
        return $this->empresa->nome ?? null;
    }

    public function getPapelNomeAttribute()
    {
        return $this->papel->nome ?? null;
    }

}
