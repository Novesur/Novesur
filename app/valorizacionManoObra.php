<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class valorizacionManoObra extends Model
{
    protected $table = 'valorizacion_manobra';
    public $timestamps = false;

    public function personal()
    {
        return $this->belongsTo(Personal::class,'personal');
    }

  
}
