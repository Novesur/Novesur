<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoExtra extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_extra';

    public function plato_extra()
    {
        return $this->belongsTo(PlatoExtra::class);
    }
}
