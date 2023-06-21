<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleMenu extends Model
{
    protected $table = 'detallemenu';

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function plato_entrada(){
        return $this->belongsTo(PlatoEntrada::class);
    }

    public function plato_segundo(){
        return $this->belongsTo(PlatoSegundo::class);
    }

    public function plato_extra(){
        return $this->belongsTo(PlatoExtra::class);
    }

    public function plato_dieta(){
        return $this->belongsTo(PlatoDieta::class);
    }





}
