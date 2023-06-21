<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleparteingreso extends Model
{
    protected $table = 'detalleparteingreso';

    public function parteingreso()
    {
        return $this->belongsTo(Parteingreso::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

 
}
