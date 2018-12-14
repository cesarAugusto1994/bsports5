<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    protected $fillable = ['tipo', 'titulo', 'descricao', 'user_id', 'ativo'];

    public function links()
    {
        return $this->hasMany('App\Models\Midia\Link', 'midia_id');
    }
}
