<?php

namespace App\Http\Controllers\Administracion;

use App\Distrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    public function index()
    {
        $dato = Distrito::all();
        return $dato;
    }
}
