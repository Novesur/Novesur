<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CatArticulo;

class CatArticuloController extends Controller
{
    public function index(){
        $dato = CatArticulo::all();
        return $dato;
    }
}
