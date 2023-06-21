<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ordencompra extends Model
{
    const PENDIENTE = 1;
    const APROBADO = 2;
    use SoftDeletes;
    protected $table = 'ordencompras';
    protected $fillable =[
        'Femision',
        'Referencia',
        'proveedor_id',
        'Fentrega',
        'LugarEntrega',
        'tipordercompra_id',
        'pago_id',
        'user_id',
        'estadoordencompra_id'

    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estadoordencompra()
    {
        return $this->belongsTo(Estadoordercompra::class);
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
    public function tipocambio()
    {
        return $this->belongsTo(Tipocambio::class);
    }

    public function detalle()
    {
        return $this->hasMany(Detalleordencompra::class,"ordencompras_id");
    }

}
