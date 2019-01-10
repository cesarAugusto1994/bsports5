<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $fillable = ['titulo', 'inicio', 'fim'];

    protected $dates = ['inicio', 'fim'];
}
