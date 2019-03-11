<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $fillable = ['nome', 'template_id'];

    public function template()
    {
        return $this->belongsTo('App\Models\Template');
    }
}
