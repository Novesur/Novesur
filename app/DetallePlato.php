<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePlato extends Model
{
    protected $table = 'detalleplato';


    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }
}

