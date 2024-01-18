<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleParteIngSali extends Model
{
    protected $table = 'detalle_parte_ing_sali';
    use SoftDeletes;

}
