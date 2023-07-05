<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class valorizacionManoObra extends Model
{
    use SoftDeletes;
    protected $table = 'valorizacion_manobra';
    public $timestamps = false;

    public function personal()
    {
        return $this->belongsTo(Personal::class,'personal');
    }

  
}
