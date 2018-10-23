<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;
use App\Models\Torneio\Resultado;
use App\Models\{Quadras, Torneio};

class Partida extends Model
{
    protected $dates = ['data','inicio','fim'];

    protected $fillable = [
      'jogador1_id', 'jogador1_resultado_final',
      'jogador1_set1',
      'jogador1_set2','jogador1_set3',
      'jogador1_tiebreak','jogador1_vitoria_wo',
      'jogador1_desistencia','jogador1_pontos',
      'jogador1_bonus','jogador1_computado',
      'jogador2_id','jogador2_resultado_final',
      'jogador2_set1','jogador2_set2','jogador2_set3',
      'jogador2_tiebreak','jogador2_vitoria_wo',
      'jogador2_desistencia','jogador2_pontos',
      'jogador2_bonus','jogador2_computado',
    ];

    public function jogadores()
    {
        return $this->hasMany(Jogador::class, 'partida_id');
    }

    public function jogador1()
    {
        return $this->belongsTo(Jogador::class, 'jogador1_id');
    }

    public function jogador2()
    {
        return $this->belongsTo(Jogador::class, 'jogador2_id');
    }

    public function resultado()
    {
        return $this->hasMany(Resultado::class, 'partida_id');
    }

    public function quadra()
    {
        return $this->belongsTo(Quadras::class, 'quadra_id');
    }

    public function torneio()
    {
        return $this->belongsTo(Torneio::class, 'torneio_id');
    }
}
