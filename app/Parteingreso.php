<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parteingreso extends Model
{
    const PENDIENTE = 1;
    const APROBADO = 2;
    protected $table = 'parteingreso';

    protected $fillable =[
        'proveedor_id',
        'Nrofactura',
        'Nroguia',
        'proveedor_id',
        'motivo_id',
        'Fecha',
        'observacion',
        'user_id',
        'estadoparte_id',

    ];


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ordencompras()
    {
        return $this->belongsTo(Ordencompra::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

}

