<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class InformeProduccion extends Model
{
    use SoftDeletes;
    protected $table = 'informeproduccion';



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

    public function requerimiento_materiales(){

        return $this->belongsTo(RequerimientosMateriales::class, 'pk_ReqMateriales', 'id');
    }


}
