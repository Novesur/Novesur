<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoProduccionManoObra extends Model
{
    use SoftDeletes;
    protected $table = 'manobra_infoproduccion';
    public $timestamps = false;
}
