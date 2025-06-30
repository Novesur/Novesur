<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicioInforme_OtrosRequerimientos extends Model
{
    use SoftDeletes;
    protected $table = 'servicioinforme_otrosrequerimientos';

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class, 'unidmedida_id');
    }
}
