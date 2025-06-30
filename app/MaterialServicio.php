<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialServicio extends Model
{
    use SoftDeletes;
    protected $table = 'material_servicio';
    public $timestamps = false;

  public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'pk_Servicios', 'id');
    }


}
