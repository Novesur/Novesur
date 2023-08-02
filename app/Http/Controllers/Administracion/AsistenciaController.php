<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Imports\AsistenciaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AsistenciaController extends Controller
{
    public function import(Request $request){

        $path= $request->file('select_file');
        $dato= is_null($path);
       if(!$dato){
           Excel::import(new AsistenciaImport, $path);
           return response()->json(['message' => 'Exportacion Realizada', 'icon' => 'success'], 200);
       }else{
        return response()->json(['message' => 'Seleccione el archivo', 'icon' => 'warning'], 200);
       }
    }
}
