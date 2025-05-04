<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionLibreDetalle extends Model
{
    protected $table = 'cotizacion_libre_detalle';
    public $timestamps = false;

    protected $fillable =[
        'cotizacion_id',
        'cantidad',
        'unidmedida_id',
        'producto',
        'punit',

    ];
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function cotizacion_libre(){
        return $this->belongsTo(CotizacionLibre::class);
    }
}
