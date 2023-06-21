<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoProduccionOtrosRequerimientos extends Model
{
    use SoftDeletes;
    protected $table = 'otrosrequerimientos_infoproduccion';
    public $timestamps = false;
}
