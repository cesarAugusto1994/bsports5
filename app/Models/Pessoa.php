<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $dates = ['nascimento'];

    public function jogador()
    {
        return $this->hasOne('App\Models\Pessoa\Jogador', 'pessoa_id');
    }
}
