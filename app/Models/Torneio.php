<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Torneio extends Model
{
    use Uuids;

    protected $fillable = ['nome', 'partidas', 'valor', 'ativo'];
}
