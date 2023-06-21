<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index(){
       $dato=  Pago::all();
       return $dato;
    }
}
