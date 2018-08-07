<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Planos, Pessoas};

class Venda extends Model
{
    protected $table = 'vendas';

    public function plano()
    {
       return $this->belongsTo(Planos::class, 'plano_id');
    }

    public function pessoa()
    {
       return $this->belongsTo(Pessoas::class, 'pessoa_id');
    }

    public function status()
    {
       return $this->belongsTo(StatusVenda::class, 'status_id');
    }
}
