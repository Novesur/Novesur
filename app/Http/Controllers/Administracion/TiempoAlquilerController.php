<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\TiempoAlquiler;
use Illuminate\Http\Request;

class TiempoAlquilerController extends Controller
{
    public function List(){
        $dato = TiempoAlquiler::all();
        return $dato;
    }
}
