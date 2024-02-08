<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\VisitasExport;
use App\Http\Controllers\Controller;
use App\VisitasVentas;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VisitaController extends Controller
{
    public function create(Request $request)
    {
        $date = Carbon::now();

        $fecha = $date->format('Y-m-d');
        $hora = $date->format('H:i');

        $visitaObra = new VisitasVentas;
        $visitaObra->fecha = $fecha;
        $visitaObra->tiempo = $hora;
        $visitaObra->departamento_id = 1;
        $visitaObra->provincia_id = 1;
        $visitaObra->distrito_id = $request->nIdDistrito;
        $visitaObra->cliente_id = $request->nIdCliente;
        $visitaObra->proyecto = $request->cProyecto;
        $visitaObra->direccion = $request->cDireccion;
        $visitaObra->estado_obra_id = $request->nidEstadoObra;
        $visitaObra->personal_contacto_id = $request->nIdContacto;
        $visitaObra->nombre = $request->cNombre;
        $visitaObra->observacion = $request->cObservacion;
        $visitaObra->user_id = $request->nIdUsuario;
        $visitaObra->save();
    }

    public function list(Request $request)
    {
        
     
        /*  Busqueda por Vendedor */
        if ($request->dFecha == NULL  and $request->nIdtEstadoVisita == NULL  and $request->nIdCliente == NULL ) {
            $dato = VisitasVentas::with('distrito','cliente','estadoObra','personal_contacto')->where('user_id', $request->nIdVendedor)->get();
            return $dato;
        };

         /*  Busqueda por Fecha */
        if ($request->nIdCliente == NULL and $request->nIdtEstadoVisita == NULL) {
            $dato = VisitasVentas::with('distrito','cliente','estadoObra','personal_contacto')->where('user_id', $request->nIdUser)
            ->whereBetween('fecha', [$request->dFechainicio, $request->dFechafin])
            ->get();
            return $dato;
        };
        
        /*  Busqueda por Cliente */
        if ($request->dFecha == NULL  and $request->nIdtEstadoVisita == NULL) {
            $dato = VisitasVentas::with('distrito','cliente','estadoObra','personal_contacto')->where('cliente_id', $request->nIdCliente)->get();
            return $dato;
        };
        /*  Busqueda por Cliente y fecha*/
        if ( $request->nIdtEstadoVisita == NULL) {
            $dato = VisitasVentas::with('distrito','cliente','estadoObra','personal_contacto')->where('cliente_id', $request->nIdCliente)
            ->whereBetween('fecha', [$request->dFechainicio, $request->dFechafin])
            ->get();
            return $dato;
        };

         /*  Busqueda por Estados */

         if ( $request->dFecha == NULL and $request->nIdCliente == NULL) {
            $dato = VisitasVentas::with('distrito','cliente','estadoObra','personal_contacto')->where('estado_obra_id', $request->nIdtEstadoVisita)
            ->get();
            return $dato;
        };
    }

    public function export(Request $request){
        $listVisitas = json_decode($request->params['listVisitas']);
        return (new VisitasExport)->setGenerarExcel($listVisitas)->download('visitas.xlsx');
    }
}
