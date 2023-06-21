<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    protected $table = 'detalle_cotizacion';
    public $timestamps = false;

    protected $fillable =[
        'cotizacion_id',
        'cantidad',
        'unidmedida_id',
        'producto_id',
        'punit',

    ];



    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class);
    }
}
