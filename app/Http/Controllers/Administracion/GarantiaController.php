<?php

namespace App\Http\Controllers\Administracion;

use App\Garantia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GarantiaController extends Controller
{
    public function index(){
        $dato= Garantia::all();
        return $dato;
    }
}
