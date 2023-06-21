<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformeValorizacion extends Model
{
    protected $table = 'informe_valorizacion';

    public function ccostos()
    {
        return $this->belongsTo(CentroCostos::class,"centro_costos_id"); 
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
