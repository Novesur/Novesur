<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectOtrosReq extends Model
{
    protected $table = 'proyecto_otrosreq';

    public function unidmedida_idInfoProy()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_idInfoProy');
    }
}
