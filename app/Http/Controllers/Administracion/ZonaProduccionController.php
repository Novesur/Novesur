<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\ZonaProduccion;
use Illuminate\Http\Request;

class ZonaProduccionController extends Controller
{
    public function list(){
        $dato=ZonaProduccion::where('estado','A')->get();
        return $dato;
    }
}
