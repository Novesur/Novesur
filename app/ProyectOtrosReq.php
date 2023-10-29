<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectOtrosReq extends Model
{
    use SoftDeletes;
    protected $table = 'proyecto_otrosreq';
    public $timestamps = false;

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_id');
    }


    public function unidmedida_idInfoValor()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_idInfoValor');
    }
}
