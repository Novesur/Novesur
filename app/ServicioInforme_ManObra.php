<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicioInforme_ManObra extends Model
{
    use SoftDeletes;
    protected $table = 'servicioinforme_manobra';
    public $timestamps = false;
}
