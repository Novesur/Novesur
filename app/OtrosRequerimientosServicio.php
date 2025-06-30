<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtrosRequerimientosServicio extends Model
{
      protected $table = 'otrosrequerimiemtos_servicio';
    public $timestamps = false;
    use SoftDeletes;

      public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_id');
    }


    public function unidmedida_idInfoValor()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_idInfoValor');
    }
}
