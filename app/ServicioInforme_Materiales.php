<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicioInforme_Materiales extends Model
{
    use SoftDeletes;
    protected $table = 'servicioinforme_materiales';
      public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function servicioInforme()
    {
        return $this->belongsTo(ServicioInforme::class, 'pk_servicio_informe', 'id');
    }


}
