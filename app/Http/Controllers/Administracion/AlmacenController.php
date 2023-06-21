<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Almacen;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = Almacen::all();

        return $dato;
    }

    public function AlmacenbyEstado()
    {
        $dato = Almacen::where('estado','A')->get();

        return $dato;
    }

}
