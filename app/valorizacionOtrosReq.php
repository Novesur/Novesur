<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class valorizacionOtrosReq extends Model
{
    use SoftDeletes;
    protected $table = 'valorizacion_otrosreq';
    public $timestamps = false;


   public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class,'unidmedida_id');
    }
    
}
