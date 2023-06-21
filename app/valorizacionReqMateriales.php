<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class valorizacionReqMateriales extends Model
{
    protected $table = 'valorizacion_reqmateriales';
    
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }
}
