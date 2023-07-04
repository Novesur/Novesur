<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class valorizacionOtrosReq extends Model
{
    protected $table = 'valorizacion_otrosreq';
    public $timestamps = false;


   public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_id');
    }
    
}
