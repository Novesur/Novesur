<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleKardex extends Model
{
    protected $table = 'detallekardex';

    protected $fillable =[
        'kardex_id',
        'fecha',
        'FactNo',
        'GuiaNo',
        'proveedor_id',
        'motivo_id',
        'unidmedida_id',
        'cantidad',
        'costunit',
        'movimiento_id',
        'user_id',
        'cliente_id',
    ];

    public function kardex()
    {
        return $this->hasOne(Kardex::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class);
    }

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
