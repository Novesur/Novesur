<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleordencompra extends Model
{
      public $timestamps = false;

    protected $table = 'detalleordencompras';
    protected $fillable =[
        'ordencompras_id',
        'producto_id',
        'cantidad',
        'unidmedida_id',
        'punit',
        'estado',
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
