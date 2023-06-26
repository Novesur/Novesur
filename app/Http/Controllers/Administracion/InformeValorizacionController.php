<?php

namespace App\Http\Controllers\Administracion;

use App\Countable;
use App\Exports\InfoValorizacionExport;
use App\Http\Controllers\Controller;
use App\InformeValorizacion;
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
                'personal' => $ProyManoObra->personal,
                'dias' =>  $ProyManoObra->dias,
                'horas' => $ProyManoObra->horas,
                'personalInfoProy' => $ProyManoObra->personal,
                'diasInfoProy' => $ProyManoObra->dias,
                'horasInfoProy' => $ProyManoObra->horas,
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
                'descripcionInfoProy' => $OtrosRequerimientos->descripcion,
                'cantidadInfoProy' => $OtrosRequerimientos->cantidad,
                'alquilerInfoProy' => $OtrosRequerimientos->idAlquiler,
                'precioInfoProy' => $OtrosRequerimientos->precioOtros,
                'estado' => $OtrosRequerimientos->estado
            ];
        });
        valorizacionOtrosReq::insert($allOtrosReque->toArray());
        DB::commit();
        Session::put('OtrosProyInfoValor', collect([])); 


        return response()->json(['message' => 'Nuevo Requerimiento Materiales agregado', 'icon' => 'success'], 200);
    }

    public function index(Request $request){
       

        if($request->cServicio == null & $request->nIdProyecto == null  & $request->cFecha == null){
            $dato = InformeValorizacion::with('ccostos')->get();
            return $dato;
        }

        //Busqueda por Fecha
        if($request->cServicio == null & $request->nIdProyecto == null ){
            $dato = InformeValorizacion::with('ccostos')->where('fecha', $request->cFecha)->get();
            return $dato;
        }

           //Busqueda por Nro Servicio
           if($request->cFecha == null & $request->nIdProyecto == null ){
            $dato = InformeValorizacion::with('ccostos')->where('ord_servicio', $request->cServicio)->get();
            return $dato;
        }

          //Busqueda por Proyecto
          if($request->cFecha == null & $request->cServicio == null ){
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

    public function setGenerarInfoValorizacionPdf(Request $request){
        
        $idReqMateriales = $request->get("params")['id'];
        $InformeValorizacion = InformeValorizacion::with('ccostos')->where('id', $idReqMateriales)->first();
        
        $valorizacionReqMateriales = valorizacionReqMateriales::with('producto','producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
        ->where(
            ['pk_informe_valorizacion' => $idReqMateriales],
            ['estado' => 'R'])
       ->get();
      
       
      
        $valorizacionManoObra = valorizacionManoObra::where('pk_informe_valorizacion', $idReqMateriales)->where('estado', 'R')->get();
        $valorizacionOtrosReq = valorizacionOtrosReq::where('pk_informe_valorizacion', $idReqMateriales)->where('estado', 'R')->get();
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


}
