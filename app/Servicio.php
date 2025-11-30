<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    protected $table = 'servicio';
    use SoftDeletes;

  public function producto()
  {
    return $this->belongsTo(Producto::class);
  }

  public function unidmedida()
  {
    return $this->belongsTo(UnidMedida::class);
  }



}