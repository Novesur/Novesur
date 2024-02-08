<?php

namespace App\Http\Controllers\Administracion;

use App\EstadoObra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoObraController extends Controller
{
    public function list(){
        $dato = EstadoObra::all();
        return $dato;
    }
}
