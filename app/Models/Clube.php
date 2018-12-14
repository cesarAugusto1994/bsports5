<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clube extends Model
{
    protected $table = 'aula_experimental';

    protected $fillable = ['nome', 'telefone', 'celular', 'email', 'idade', 'categoria', 'classificacao'];
}
