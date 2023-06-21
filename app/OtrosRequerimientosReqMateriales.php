<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtrosRequerimientosReqMateriales extends Model
{
    protected $table = 'otrosrequerimientos_reqmateriales';
    public $timestamps = false;
    use SoftDeletes;
   
}
