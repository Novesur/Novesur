<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordencompra extends Model
{
    const ATENDIDO = 1;
    const PENDIENTE = 2;
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

    public function tipordercompra()
    {
        return $this->belongsTo(TipOrdencompra::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estadoOrderCompra()
    {
        return $this->belongsTo(EstadoOrderCompra::class);
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
}
