<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioInforme extends Model
{
    protected $table = 'servicio_informe';

    public function servicio()
      {
          return $this->belongsTo(Servicio::class,  'id');
      }
}

