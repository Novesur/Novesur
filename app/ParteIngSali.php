<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParteIngSali extends Model
{

    const Compra = 'C';
    const Servicio = 'S';
    const Ninguno = 'N';

     protected $table = 'parte_ing_sali';
     use SoftDeletes;

     protected $fillable = [
          'codigo',
          'Nrofactura',
          'Nroguia',
          'Nroordencompras',
          'proveedor_id',
          'motivo_id',
          'Fecha',
          'observacion',
          'user_id',
          'almacen_id',
          'cliente_id',
          'movimiento_id',
          'estadopedido_id',

      ];
}
