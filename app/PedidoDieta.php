<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoDieta extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_dieta';


    public function plato_dieta()
    {
        return $this->belongsTo(PlatoDieta::class);
    }
}
