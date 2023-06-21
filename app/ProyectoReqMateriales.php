<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoReqMateriales extends Model
{
    protected $table = 'proyecto_reqmateriales';

    public function ccostos()
    {
        return $this->belongsTo(CentroCostos::class,"centro_costos_id"); 
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}

