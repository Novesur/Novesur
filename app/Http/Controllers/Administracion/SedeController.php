<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
     public function list(Request $request)
    {
        $dato = Sede::all();
        return $dato;
    }
}
