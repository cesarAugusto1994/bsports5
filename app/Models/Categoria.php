<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;

class Categoria extends Model
{
    protected $fillable = ['nome', 'tipo', 'ativo'];

    public function jogadores()
    {
        return $this->hasMany(Jogador::class, 'categoria_id');
    }
}
