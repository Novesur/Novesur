<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoManObra extends Model
{
    protected $table = 'proyecto_manobra';

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
