<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoMateriales extends Model
{
    protected $table = 'proyecto_materiales';
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }
}
