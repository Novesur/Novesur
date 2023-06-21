<?php

namespace App\Http\Controllers\Administracion;

use App\CentroCostos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CentroCostosController extends Controller
{
 
    public function search( Request $request){
        $dato = CentroCostos::where('codigo',$request->nIdCcostos)->first();
        return $dato;
     }
     public function list(){
        $data =  CentroCostos::all();
        return $data;
  
      }
}
