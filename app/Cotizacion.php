<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizacion';

    protected $fillable =[
        'fecha',
        'cliente_id',
        'user_id',
        'estadopedido_id',
        'validezoferta',
        'Entrega',
        'tipopago_id',
        'descripcionTipopago',
        'flete',
        'documentacion',
        'garantia',
    ];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tipopago()
    {
        return $this->belongsTo(Tipopago::class);
    }
    public function estadopedido()
    {
        return $this->belongsTo(EstadoPedido::class);
    }
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
    public function garantia()
    {
        return $this->belongsTo(Garantia::class);
    }
}

