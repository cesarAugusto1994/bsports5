<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['titulo', 'conteudo', 'link', 'video', 'banner', 'ativo'];
}
