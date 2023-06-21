<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoEntrada extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_entrada';


    public function plato_entrada()
    {
        return $this->belongsTo(PlatoEntrada::class);
    }
}
