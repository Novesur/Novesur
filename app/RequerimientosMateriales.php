<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientosMateriales extends Model
{
    protected $table = 'requerimiento_materiales';


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
    public function zona_produccion()
    {
        return $this->belongsTo(ZonaProduccion::class);
    }
}
