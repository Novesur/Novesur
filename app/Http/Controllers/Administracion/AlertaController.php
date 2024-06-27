<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\AlertasContabilidad;
use App\Exports\AlertContabilidadExport;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function create(Request $request)
    {
        $formatreq = date("Y-m-d");
        $alertasContabilidad = new AlertasContabilidad();
        $alertasContabilidad->fRegistro = $formatreq;
        $alertasContabilidad->fVencimiento = $request->cFechaVencimiento;
        $alertasContabilidad->obligacion =  mb_strtoupper($request->cObligacion);
        $alertasContabilidad->entidad =  mb_strtoupper($request->cEntidad);
        $alertasContabilidad->importe = $request->cImporte;
        $alertasContabilidad->tipocambio_id = $request->nIdTipoMoneda;
        $alertasContabilidad->user_id = $request->nIdUsuario;
        $alertasContabilidad->estadopedido_id = 4;
        $alertasContabilidad->save();
        return response()->json(['message' => 'Dato agregado', 'icon' => 'success'], 200);
    }

    public function list(Request $request)
    {

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        if (is_null($fecha1) and is_null($fecha2)) {
            $dato = AlertasContabilidad::with('tipocambio', 'user')->where('estadopedido_id', $request->rEstados)->get();
            return $dato;
        } else {
            $dato = AlertasContabilidad::with('tipocambio', 'user')->whereBetween('fVencimiento', [$fecha1, $fecha2])->orderBy('fVencimiento', 'DESC')->where('estadopedido_id', $request->rEstados)->get();
            return $dato;
        }
    }

    public function setEstadoAtendido(Request $request)
    {

        AlertasContabilidad::where('id', $request->id)->update(['estadopedido_id' => 3]);
    }

    public function ExcelAlertasByFecha(Request $request)
    {
        $listAlertasByDate = json_decode($request->params['listAlertasByDate']);
        return (new AlertContabilidadExport)->setGenerarExcel($listAlertasByDate)->download('invoices.xlsx');
    }
}
