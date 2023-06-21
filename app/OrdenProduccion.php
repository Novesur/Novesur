<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenProduccion extends Model
{
    protected $table = 'ordenproduccion';

    use SoftDeletes;

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }


}

