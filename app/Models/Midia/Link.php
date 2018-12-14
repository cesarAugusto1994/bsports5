<?php

namespace App\Models\Midia;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'midia_links';
    
    protected $fillable = ['midia_id', 'link'];
}
