<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notapedido extends Model
{
    public function vendedor()
    {
        return $this->hasMany(User::class,'id','vendedor_id');
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
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
