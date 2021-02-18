<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EstadoProducto;

class EstadoProdController extends Controller
{
    public function index()
    {
        $dato = EstadoProducto::all();
        return $dato;
    }
}
