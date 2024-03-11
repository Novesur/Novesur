<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoAlmacen extends Model
{
    use SoftDeletes; 
    protected $table = 'movimiento_almacen';
    protected $fillable = ['estadopedido_id'];

    public function tipo_traslado()
    {
        return $this->belongsTo(TipoTraslado::class); 
    }

    public function puntopartida()
    {
        return $this->hasMany(Almacen::class,'id','puntopartida_id'); 
    }

    public function puntollegada()
    {
        return $this->hasMany(Almacen::class,'id','puntollegada_id'); 
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class); 
    }

    public function motivotraslado()
    {
        return $this->belongsTo(MotivoTraslado::class); 
    }

    public function modalidadtransporte()
    {
        return $this->belongsTo(ModalidadTransporte::class); 
    }

    public function estadopedido()
    {
        return $this->belongsTo(EstadoPedido::class); 
    }
}
