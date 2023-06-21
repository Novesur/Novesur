<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model

{
    use SoftDeletes;

    protected $table = 'cotizacion';

    protected $fillable =[
        'fecha',
        'cliente_id',
        'user_id',
        'estadopedido_id',
        'validezoferta',
        'Entrega',
        'tipopago_id',
        'pago_id',
        'flete',
        'documentacion',
        'garantia_id',
        'codigo',
    ];
    protected $dates = ['deleted_at'];

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
    public function detalle()
    {
        return $this->hasMany(DetalleCotizacion::class,"cotizacion_id"); 
    }
}

