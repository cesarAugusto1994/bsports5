<?php

namespace App\Models\Pessoa;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneio\Resultado;
use App\Models\Jogador\Mensalidade;
use App\Models\{Categoria, Pessoa, Partida};
use Emadadly\LaravelUuid\Uuids;

class Jogador extends Model
{
    use Uuids;
    protected $table = 'jogadores';

    protected $dates = ['nascimento'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'jogador_id');
    }

    public function partidas()
    {
        return $this->hasMany(Partida::class, 'jogador1_id');
    }

    public function partidas2()
    {
        return $this->hasMany(Partida::class, 'jogador2_id');
    }

    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class, 'jogador_id');
    }

    public function semanas()
    {
        return $this->hasMany('App\Models\Semana', 'jogador_id');
    }
/*
    public function partidas()
    {
        return $this->hasManyThrough(Resultado::class, Partida::class, 'jogador_id', 'partida_id', 'id', 'id');
    }
*/
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'jogador_id');
    }
}
