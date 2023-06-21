<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNotapedido extends Model
{
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
