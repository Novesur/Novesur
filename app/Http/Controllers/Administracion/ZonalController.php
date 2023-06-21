<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Zonal;
use Illuminate\Http\Request;

class ZonalController extends Controller
{
   public function List(){
    $dato = Zonal::all();
    return $dato;
   }

 
}
