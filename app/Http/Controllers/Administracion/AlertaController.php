<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\AlertasContabilidad;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function create(Request $request){
        $formatreq = date("Y-m-d");
        $alertasContabilidad = new AlertasContabilidad();
        $alertasContabilidad->fRegistro = $formatreq;
        $alertasContabilidad->fVencimiento = $request->cFechaVencimiento;
        $alertasContabilidad->obligacion =  mb_strtoupper($request->cObligacion);
        $alertasContabilidad->entidad =  mb_strtoupper($request->cEntidad);
        $alertasContabilidad->importe = $request->cImporte; 
        $alertasContabilidad->tipocambio_id = $request->nIdTipoMoneda;
        $alertasContabilidad->user_id = $request->nIdUsuario;
        $alertasContabilidad->save();
        return response()->json(['message' => 'Dato agregado', 'icon' => 'success'], 200); 
    }
}
