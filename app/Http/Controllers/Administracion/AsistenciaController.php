<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Imports\AsistenciaImport;
use App\Personal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


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

    public function listAsistByDate(Request $request){
        
        if (!$request->ajax()) return redirect('/');
        $fechaActual = $request->fechaActual;

        $fechaActual = ($fechaActual == NULL) ? ($fechaActual = 0) : $fechaActual;
        
        $rpta = DB::select('call sp_AsistenciaByDay (?)', [
            $fechaActual
        ]);
        return $rpta;
    }

    public function  listByDatePersonal(Request $request){

        $personal = Personal::find($request->personal);
    
        if (!$request->ajax()) return redirect('/');
        $dFechainicio = $request->dFechainicio;
        $dFechainicio = ($dFechainicio == NULL) ? ($dFechainicio = 0) : $dFechainicio;

        $dFechafin = $request->dFechafin;
        $dFechafin = ($dFechafin == NULL) ? ($dFechafin = 0) : $dFechafin;
        
        $rpta = DB::select('call sp_AsistenciasReportByDatePersonal (?,?,?)', [
            $dFechainicio,
            $dFechafin,
            $personal->codigo

        ]);
        return $rpta;

      

    }
}
