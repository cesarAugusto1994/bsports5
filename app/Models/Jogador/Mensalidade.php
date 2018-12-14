<?php

namespace App\Models\Jogador;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;
use App\Models\Mensalidade\Status;
use App\Models\Pessoa;
use Emadadly\LaravelUuid\Uuids;

class Mensalidade extends Model
{
    use Uuids;

    protected $dates = ['vencimento', 'data_pagamento'];

    public function jogador()
    {
        return $this->belongsTo(Jogador::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function log()
    {
        return $this->hasMany('App\Models\Mensalidade\Log', 'mensalidade_id');
    }
}
