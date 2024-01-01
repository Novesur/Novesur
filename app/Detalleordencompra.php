<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleordencompra extends Model
{
    const GRABADO = 2;
    const SELECTTRUE = 1;
    const SELECTFALSE = 0;


      public $timestamps = false;

    protected $table = 'detalleordencompras';
    protected $fillable =[
        'ordencompras_id',
        'producto_id',
        'cantidad',
        'cantidadKardex',
        'unidmedida_id',
        'punit',
        'estado',
        'grabado',
        'canting'
    ];
    public function ordencompras()
    {
        return $this->belongsTo(Ordencompra::class);
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
