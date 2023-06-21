<?php

namespace App\Http\Controllers\Administracion;

use App\Cargo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function create(Request $request){
        $cargo = new Cargo;
        $cargo->nombre =  mb_strtoupper($request->cNombre);
        $cargo->save();
    }

    public function index(Request $request){

        if($request->cNombre == NULL){
            $dato = Cargo::all();
            return $dato;
        }else{
            $dato = Cargo::where('nombres', 'like', '%' . $request->cNombre . '%')->get();
            return $dato;
        }
    }

    public function list(){
        $dato = Cargo::all();
            return $dato;
    }

    public function listByIdCargos(Request $request){
        $dato = Cargo::where('id',$request->nIdCargo)->first();
        return $dato;

    }

    public function edit(Request $request){
        $nIdCargo = $request->nIdCargo;
        $Cargo = Cargo::where('id', $nIdCargo)->first();
        if ($Cargo) {
            $Cargo->nombres = mb_strtoupper($request->cNombre);
            $Cargo->save();
        }
    }
}
