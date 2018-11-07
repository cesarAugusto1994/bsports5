<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoPartida extends Model
{
    protected $table = 'solicitacao_partidas';

    protected $fillable = ['nome','email','telefone','data','horario'];
}
