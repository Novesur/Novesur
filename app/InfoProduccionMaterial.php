<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoProduccionMaterial extends Model
{
    use SoftDeletes;
    protected $table = 'material_infoproduccion';
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }
}
