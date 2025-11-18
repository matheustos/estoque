<?php

namespace App\Modules\Empresas\Models;

use App\Modules\Almoxarifados\Models\Almoxarifado;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Produtos\Models\Produto;
use App\Modules\Usuarios\Models\Usuario;
use Carbon\Carbon;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nome',
        'data_criacao'
    ];

    /**
     * Relacionamento: Empresa tem muitos produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    /**
     * Relacionamento: Empresa tem muitos usuários
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    // Busca todos os almoxarifados de uma empresa
    public function almoxarifados()
    {
        return $this->hasMany(Almoxarifado::class);
    }

    public $timestamps = false;
}
