<?php

namespace App\Http\Controllers\Administracion;

use App\Departamento;
use App\Distrito;
use App\Http\Controllers\Controller;
use App\Provincia;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{

    public function departamentos()
    {
        $dato = Departamento::all();
        return $dato;
    }

    public function provincias(Request $request)
    {
        
        $dato = Provincia::where('departamento_id',$request->departamento)->get();
        return $dato;
    }
    public function distritos(Request $request)
    {
        $dato = Distrito::where('provincia_id',$request->idProvincia)->get();
        return $dato;
    }



    
}
