<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoSegundo extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_segundo';

    public function plato_segundo()
    {
        return $this->belongsTo(PlatoSegundo::class);
    }
}
