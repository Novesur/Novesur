<?php

namespace App\Http\Controllers\Administracion;

use App\Countable;
use App\Exports\InfoValorDetalleExport;
use App\Exports\InfoValorizacionExport;
use App\Http\Controllers\Controller;
use App\InformeValorizacion;
use App\ProyectoManObra;
use App\ProyectoMateriales;
use App\ProyectoReqMateriales;
use App\ProyectOtrosReq;
use App\TiempoAlquiler;
use App\valorizacionManoObra;
use App\valorizacionOtrosReq;
use App\valorizacionReqMateriales;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\DB;

class InformeValorizacionController extends Controller
{
    public function create(Request $request)
    {

        $yearMaxID = date("Y");
        //$maxidPReqMat = RequerimientosMateriales::whereRaw('id = (select max(`id`) from requerimiento_materiales)')->first();
        $countable = Countable::all();
        $countMaxInformeValorizacion = $countable[0]->countInformeValorizacion;
        if ($countMaxInformeValorizacion == 0) {
            $maxidPReqMat = 'INFVAL0001' . '-' . $yearMaxID;
        } else {

            $maxidPReqMat = 'INFVAL' . sprintf('%04d', $countMaxInformeValorizacion + 1) . '-' . $yearMaxID;
        }

        $ProyectoReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->get();



        foreach ($ProyectoReqMateriales as $dataProyReqMateral) {

            $InformeValorizacion = new InformeValorizacion();
            $InformeValorizacion->codigo = $maxidPReqMat;
            $InformeValorizacion->fecha = $dataProyReqMateral->fecha;
            $InformeValorizacion->centro_costos_id = $dataProyReqMateral->centro_costos_id;
            $InformeValorizacion->cliente = $dataProyReqMateral->cliente;
            $InformeValorizacion->detservicio = $dataProyReqMateral->detservicio;
            $InformeValorizacion->fechainicio = $dataProyReqMateral->fechainicio;
            $InformeValorizacion->fechafinal = $dataProyReqMateral->fechafinal;
            $InformeValorizacion->duracion = $dataProyReqMateral->duracion;
            $InformeValorizacion->ord_servicio = $dataProyReqMateral->ord_servicio;
            $InformeValorizacion->importe = $request->cImporte;
            $InformeValorizacion->user_id = $request->nIdUser;
            $InformeValorizacion->pk_proyecto_reqmateriales = $dataProyReqMateral->id;
            $InformeValorizacion->save();
        }


        Countable::where('id', 1)->update(['countInformeValorizacion' => $countMaxInformeValorizacion + 1]);


        $ProyectoMateriales = ProyectoMateriales::where('pk_proyecto_reqmateriales', $ProyectoReqMateriales[0]->id)->get();
        foreach ($ProyectoMateriales as $dataProyReq) {

            $valorizacionReqMateriales = new valorizacionReqMateriales();
            $valorizacionReqMateriales->pk_informe_valorizacion = $InformeValorizacion->id;
            $valorizacionReqMateriales->producto_id = $dataProyReq->producto_id;
            $valorizacionReqMateriales->cantidad = $dataProyReq->cantInfoValor;
            $valorizacionReqMateriales->unidmedida_id = $dataProyReq->unidmedidaInfoValor_id;
            $valorizacionReqMateriales->fecha = $dataProyReq->fecha;
            $valorizacionReqMateriales->costunit = 0;
            $valorizacionReqMateriales->total = 0;
            $valorizacionReqMateriales->save();
        }

        $ProyectoManObra = ProyectoManObra::where('pk_proyecto_reqmateriales', $ProyectoReqMateriales[0]->id)->get();

        foreach ($ProyectoManObra as $dataProyManObra) {

            $valorizacionManoObra = new valorizacionManoObra();
            $valorizacionManoObra->pk_informe_valorizacion = $InformeValorizacion->id;
            $valorizacionManoObra->personal_id = $dataProyManObra->personalInfoValor;
            $valorizacionManoObra->dias = $dataProyManObra->diasInfoValor;
            $valorizacionManoObra->horas = $dataProyManObra->horasInfoValor;
            $valorizacionManoObra->costdias = 0;
            $valorizacionManoObra->costhoras = 0;
            $valorizacionManoObra->total = 0;
            $valorizacionManoObra->save();
        }

        $ProyectOtrosReq = ProyectOtrosReq::where('pk_proyecto_reqmateriales', $ProyectoReqMateriales[0]->id)->get();

        foreach ($ProyectOtrosReq as $dataProyOtrosReq) {

            $valorizacionOtrosReq = new valorizacionOtrosReq();
            $valorizacionOtrosReq->pk_informe_valorizacion = $InformeValorizacion->id;
            $valorizacionOtrosReq->descripcion = $dataProyOtrosReq->descripcionInfoValor;
            $valorizacionOtrosReq->cantidad = $dataProyOtrosReq->cantidadInfoValor;
            $valorizacionOtrosReq->precio = 0;
            $valorizacionOtrosReq->alquiler = 0;
            $valorizacionOtrosReq->pk_tiempo_alquiler = 1;
            $valorizacionOtrosReq->unidmedida_id = $dataProyOtrosReq->unidmedida_idInfoValor;
            $valorizacionOtrosReq->total = 0;
            $valorizacionOtrosReq->save();
        }
        return response()->json(['message' => 'Nuevo Requerimiento Materiales agregado', 'icon' => 'success'], 200);

        /*      $yearMaxID = date("Y");
        //$maxidPReqMat = RequerimientosMateriales::whereRaw('id = (select max(`id`) from requerimiento_materiales)')->first();
        $countable = Countable::all();
        $countMaxInformeValorizacion = $countable[0]->countInformeValorizacion;
        if ($countMaxInformeValorizacion == 0) {
            $maxidPReqMat = 'INFVAL0001' . '-' . $yearMaxID;
        } else {

            $maxidPReqMat = 'INFVAL' . sprintf('%04d', $countMaxInformeValorizacion + 1) . '-' . $yearMaxID;
        }

        $dateIni = Carbon::parse($request->FInicio)->format('Y-m-d');
        $dateFinal = Carbon::parse($request->FFinal)->format('Y-m-d');
        $fecha = date('Y-m-d');

        $InformeValorizacion = new InformeValorizacion();
        $InformeValorizacion->codigo = $maxidPReqMat;
        $InformeValorizacion->fecha = $fecha;
        $InformeValorizacion->centro_costos_id = $request->nIdCcostos;
        $InformeValorizacion->cliente = $request->nIdClient;
        $InformeValorizacion->detservicio = $request->detservicio;
        $InformeValorizacion->fechainicio = $dateIni;
        $InformeValorizacion->fechafinal = $dateFinal;
        $InformeValorizacion->duracion = $request->cDuracion;
        $InformeValorizacion->ord_servicio = $request->nIdOS;
        $InformeValorizacion->importe = $request->cImporte;
        $InformeValorizacion->user_id = $request->nIdUser;
        $InformeValorizacion->save();

        Countable::where('id', 1)->update(['countInformeValorizacion' => $countMaxInformeValorizacion + 1]);


     $proyectoMaterial = Session::get('InfoValorMaterial');
        $allMaterialreqMat = $proyectoMaterial->map(function ($MaterialOP) use ($InformeValorizacion) {
            $formatreq = date("Y-m-d");
            return [
                'pk_informe_valorizacion' => $InformeValorizacion->id,
                'producto_id' => $MaterialOP->producto_id,
                'cantidad' => $MaterialOP->cantidad,
                'unidmedida_id' =>  $MaterialOP->unidMedida_id,
                'cantInfProd'  => $MaterialOP->cantidad,
                'fecha' =>  $formatreq,
                'estado' => $MaterialOP->estado
            ];
        });
        valorizacionReqMateriales::insert($allMaterialreqMat->toArray());
        DB::commit();
        Session::put('InfoValorMaterial', collect([]));


        $ProyManoObra = Session::get('InfoValorManObra');
        $allRequerimientoObra = $ProyManoObra->map(function ($ProyManoObra) use ($InformeValorizacion) {
            return [
                'pk_informe_valorizacion' => $InformeValorizacion->id,
                'personal_id' => $ProyManoObra->personal,
                'dias' =>  $ProyManoObra->dias,
                'horas' => $ProyManoObra->horas,
                'estado' => $ProyManoObra->estado

            ];
        });
        valorizacionManoObra::insert($allRequerimientoObra->toArray());
        DB::commit();
        Session::put('InfoValorManObra', collect([]));

        $OtrosRequerimientos = Session::get('OtrosProyInfoValor');
        $allOtrosReque =  $OtrosRequerimientos->map(function ($OtrosRequerimientos) use ($InformeValorizacion) {
            return [
                'pk_informe_valorizacion' => $InformeValorizacion->id,
                'descripcion' => $OtrosRequerimientos->descripcion,
                'cantidad' => $OtrosRequerimientos->cantidad,
                'precio' => $OtrosRequerimientos->precioOtros,
                'alquiler' => $OtrosRequerimientos->cCantAlq,
                'pk_tiempo_alquiler' => $OtrosRequerimientos->idAlquiler,
                'unidmedida_id' => $OtrosRequerimientos->unidmedida_idInfoProy,
                'estado' => $OtrosRequerimientos->estado
            ];
        });
        valorizacionOtrosReq::insert($allOtrosReque->toArray());
        DB::commit();
        Session::put('OtrosProyInfoValor', collect([])); 


 */
    }

    public function index(Request $request)
    {


        if ($request->cServicio == null & $request->nIdProyecto == null  & $request->cFecha == null) {
            $dato = InformeValorizacion::with('ccostos')->get();

            return $dato;
        }

        //Busqueda por Fecha
        if ($request->cServicio == null & $request->nIdProyecto == null) {
            $dato = InformeValorizacion::with('ccostos')->where('fecha', $request->cFecha)->get();
            return $dato;
        }

        //Busqueda por Nro Servicio
        if ($request->cFecha == null & $request->nIdProyecto == null) {
            $dato = InformeValorizacion::with('ccostos')->where('ord_servicio', $request->cServicio)->get();
            return $dato;
        }

        //Busqueda por Proyecto
        if ($request->cFecha == null & $request->cServicio == null) {
            $dato = InformeValorizacion::with('ccostos')->where('centro_costos_id', $request->nIdProyecto)->get();
            return $dato;
        }
    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listPInfoValorizacion = json_decode($request->params['listPInfoValorizacion']);
        return (new InfoValorizacionExport)->setGenerarExcel($listPInfoValorizacion)->download('invoices.xlsx');
    }


    public function setGenerarInfoValorizacionPdf(Request $request)
    {

        $idReqMateriales = $request->get("params")['id'];
        $InformeValorizacion = InformeValorizacion::with('ccostos')->where('id', $idReqMateriales)->first();

        $valorizacionReqMateriales = valorizacionReqMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
            ->where('pk_informe_valorizacion', $idReqMateriales)
            ->get();
        $valorizacionManoObra = valorizacionManoObra::with('personal')->where('pk_informe_valorizacion', $idReqMateriales)->get();
        $valorizacionOtrosReq = valorizacionOtrosReq::where('pk_informe_valorizacion', $idReqMateriales)->get();
        $logo = asset('img/logo.gif');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.informeValorizacion.InformeValorizacion', [
            'logo' => $logo,
            'InformeValorizacion' => $InformeValorizacion,
            'valorizacionReqMateriales' => $valorizacionReqMateriales,
            'valorizacionManoObra' => $valorizacionManoObra,
            'valorizacionOtrosReq' => $valorizacionOtrosReq,
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function ExcelDetalladoInfoValor(Request $request){
       
        $idReqMateriales = $request->get("params")['item'];
        $diaActual = Carbon::now()->format('d/m/Y');
        $InformeValorizacion = InformeValorizacion::with( 'ccostos', 'user','proyectoReqMateriales')->where('id', $idReqMateriales)->first();
        $valorizacionReqMateriales = valorizacionReqMateriales::with('producto')->where('pk_informe_valorizacion', $idReqMateriales)->get();
        $valorizacionManoObra = valorizacionManoObra::where('pk_informe_valorizacion', $idReqMateriales)->get();
        $valorizacionOtrosReq = valorizacionOtrosReq::where('pk_informe_valorizacion', $idReqMateriales)->get();
        return (new InfoValorDetalleExport)->setGenerarExcel($InformeValorizacion, $valorizacionReqMateriales,$valorizacionManoObra,  $valorizacionOtrosReq, $diaActual )->download('invoices.xlsx'); 
    }

    public function mostrarInfoReqMateriales(Request $request)
    {
        $datos = valorizacionReqMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->where('pk_informe_valorizacion', $request->item)->get();
        return $datos;
    }

    public function mostrarInfoManObra(Request $request)
    {

        $datos = valorizacionManoObra::with('personal')->where('pk_informe_valorizacion', $request->item)->get();
        return $datos;
    }

    public function mostrarInfOtrosReq(Request $request)
    {

        $datos = valorizacionOtrosReq::with('unidmedida', 'pk_tiempo_alquiler')->where('pk_informe_valorizacion', $request->item)->get();
        return $datos;
    }

    public function editPrecioMatInfoValor(Request $request)
    {

        valorizacionReqMateriales::where('id', $request->item)->update(['costunit' => $request->precioMatInfoValor, 'total' => $request->totalInfoValor]);
    }

    public function editPrecioDiaOdrProd(Request $request)
    {
        valorizacionManoObra::where('id', $request->id)->update(['costdias' => $request->precioDia, 'total' => $request->total]);
    }

    public function editPrecioOtrosOrdProd(Request $request)
    {

        valorizacionOtrosReq::where('id', $request->id)->update(['precio' => $request->precioDia, 'total' => $request->total]);
    }

    public function listUnidAlquiler()
    {
        $dato = TiempoAlquiler::all();
        return $dato;
    }

    public function getAlquiler(Request $request)
    {
        $dato = valorizacionOtrosReq::with('pk_tiempo_alquiler')->where('id', $request->id)->where('pk_informe_valorizacion', $request->pk_informe_valorizacion)->first();
        return $dato;
    }

    public function EditOtrosReqAlquiler(Request $request)
    {

        valorizacionOtrosReq::where('id', $request->id)->update(['unidmedida_id' => $request->IdUnidMed, 'pk_tiempo_alquiler' => $request->nIdAlquiler]);
    }
    public function editPrecioOtrosReq(Request $request)
    {

        valorizacionOtrosReq::where('id', $request->id)->update(['precio' => $request->precioDia, 'total' => $request->total]);
    }
}
