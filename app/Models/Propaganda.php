<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Propaganda extends Model
{
    use Uuids;

    protected $fillable = ['nome', 'modelo_id', 'conteudo'];
}
