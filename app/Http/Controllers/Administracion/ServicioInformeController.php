<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\InfoServicioExport;
use App\Exports\InfoValorServicioExport;
use App\Http\Controllers\Controller;
use App\Servicio;
use App\ServicioInforme;
use App\ServicioInforme_ManObra;
use App\ServicioInforme_Materiales;
use App\ServicioInforme_OtrosRequerimientos;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ServicioInformeController extends Controller
{

       public function index(Request $request)
    {


        if ($request->cServicio == null   & $request->cFecha == null) {
            $dato = ServicioInforme::with('servicio')->get();

            return $dato;
        }

        //Busqueda por Fecha
        if ($request->cServicio == null ) {
            $dato = ServicioInforme::with('servicio')->where('fecha', $request->cFecha)->get();
            return $dato;
        }

        //Busqueda por Nro Servicio
        if ($request->cFecha == null ) {
            $dato = ServicioInforme::with('servicio')->where('ord_servicio', $request->cServicio)->get();
            return $dato;
        }

        //Busqueda por Proyecto
        if ($request->cFecha == null & $request->cServicio == null) {
            $dato = ServicioInforme::with('servicio')->where('centro_costos_id', $request->nIdProyecto)->get();
            return $dato;
        }
    }


       public function SetGenerarInfoServicioPDF(Request $request)
    {

        $idReqMateriales = $request->get("params")['id'];
        $InformeServicio = ServicioInforme::where('id', $idReqMateriales)->first();

        $valorizacionReqMateriales = ServicioInforme_Materiales::with('servicioInforme','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
        ->where('pk_servicio_informe', $idReqMateriales)
        ->get();

        $valorizacionManoObra = ServicioInforme_ManObra::where('pk_servicio_informe', $idReqMateriales)->get();
        $valorizacionOtrosReq = ServicioInforme_OtrosRequerimientos::with('unidmedida')->where('pk_servicio_informe', $idReqMateriales)->get();



        $logo = asset('img/logo.gif');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.servicio.reporteProyecto', [
            'logo' => $logo,
            'InformeServicio' => $InformeServicio,
            'valorizacionReqMateriales' => $valorizacionReqMateriales,
            'valorizacionManoObra' => $valorizacionManoObra,
            'valorizacionOtrosReq' => $valorizacionOtrosReq,
        ]);
        return $pdf->download('invoice.pdf');
    }

     public function mostrarInfoReqMateriales(Request $request)
    {

        $datos = ServicioInforme_Materiales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->where('pk_servicio_informe', $request->item)->get();
        return $datos;
    }



     public function editPrecioMatInfoServicio(Request $request)
    {

        ServicioInforme_Materiales::where('id', $request->item)->update(['costunit' => $request->precioMatInfoValor, 'total' => $request->totalInfoValor]);
    }

    public function editPrecioDiaOdrProd(Request $request)
    {
        ServicioInforme_ManObra::where('id', $request->id)->update(['costdias' => $request->precioDia, 'total' => $request->total]);
    }
      public function  editPrecioHoraOdrProd(Request $request){


         ServicioInforme_ManObra::where('id', $request->id)->update(['costhoras' => $request->precioHora, 'total' => $request->total]);
    }

     public function editPrecioOtrosOrdProd(Request $request)
    {

        ServicioInforme_OtrosRequerimientos::where('id', $request->id)->update(['precio' => $request->precioDia, 'total' => $request->total]);
    }

       public function ExcelDetalladoInfoServicio(Request $request){

        $idReqMateriales = $request->get("params")['item'];
        $diaActual = Carbon::now()->format('d/m/Y');
        $servicioInforme = ServicioInforme::with( 'servicio')->where('id', $idReqMateriales)->first();
        $servicioInforme_Materiales = ServicioInforme_Materiales::with('producto')->where('pk_servicio_informe', $idReqMateriales)->get();
        $servicioInforme_ManObra = ServicioInforme_ManObra::where('pk_servicio_informe', $idReqMateriales)->get();
        $servicioInforme_OtrosRequerimientos = ServicioInforme_OtrosRequerimientos::where('pk_servicio_informe', $idReqMateriales)->get();
        return (new InfoValorServicioExport)->setGenerarExcel($servicioInforme, $servicioInforme_Materiales,$servicioInforme_ManObra,  $servicioInforme_OtrosRequerimientos, $diaActual )->download('invoices.xlsx');
    }

        public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listPInfoServicio = json_decode($request->params['listPInfoServicio']);
        return (new InfoServicioExport)->setGenerarExcel($listPInfoServicio)->download('invoices.xlsx');
    }

    public function create(Request $request){



    ServicioInforme::where('ord_servicio', $request->codRequMateriales)->update(['cantidad' => $request->cCantidad]);
    }
}
