<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallepartesalida extends Model
{
    protected $table = 'detallepartesalida';
    public $timestamps = false;

    public function partesalida()
    {
        return $this->belongsTo(Partesalida::class);
    }

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
