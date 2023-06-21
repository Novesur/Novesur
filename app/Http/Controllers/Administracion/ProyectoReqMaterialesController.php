<?php

namespace App\Http\Controllers\Administracion;


use App\Countable;
use App\Exports\PReqMaterialesExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ProyectoManObra;
use App\ProyectoMateriales;
use App\ProyectoReqMateriales;
use App\ProyectOtrosReq;
use Illuminate\Http\Request;
use PDF;

class ProyectoReqMaterialesController extends Controller
{


    public function create(Request $request)
    {

        $yearMaxID = date("Y");
        //$maxidPReqMat = RequerimientosMateriales::whereRaw('id = (select max(`id`) from requerimiento_materiales)')->first();
        $countable = Countable::all();
        $countMaxreqmateriales = $countable[0]->countProyectReqMaterial;
        if ($countMaxreqmateriales == 0) {
            $maxidPReqMat = 'PROY0001' . '-' . $yearMaxID;
        } else {

            $maxidPReqMat = 'PROY' . sprintf('%04d', $countMaxreqmateriales + 1) . '-' . $yearMaxID;
        }

        $dateIni = Carbon::parse($request->FInicio)->format('Y-m-d');
        $dateFinal = Carbon::parse($request->FFinal)->format('Y-m-d');
        $fecha = date('Y-m-d');

        $proyectoReqMateriales = new ProyectoReqMateriales();
        $proyectoReqMateriales->codigo = $maxidPReqMat;
        $proyectoReqMateriales->fecha = $fecha;
        $proyectoReqMateriales->centro_costos_id = $request->nIdCcostos;
        $proyectoReqMateriales->cliente = $request->nIdClient;
        $proyectoReqMateriales->detservicio = $request->detservicio;
        $proyectoReqMateriales->fechainicio = $dateIni;
        $proyectoReqMateriales->fechafinal = $dateFinal;
        $proyectoReqMateriales->duracion = $request->cDuracion;
        $proyectoReqMateriales->ord_servicio = $request->nIdOS;
        $proyectoReqMateriales->user_id = $request->nIdUser;
        $proyectoReqMateriales->save();

        Countable::where('id', 1)->update(['countProyectReqMaterial' => $countMaxreqmateriales + 1]);


        $proyectoMaterial = Session::get('proyectoMaterial');
        $allMaterialreqMat = $proyectoMaterial->map(function ($MaterialOP) use ($proyectoReqMateriales) {
            $formatreq = date("Y-m-d");
            return [
                'pk_proyecto_reqmateriales' => $proyectoReqMateriales->id,
                'producto_id' => $MaterialOP->producto_id,
                'cantidad' => $MaterialOP->cantidad,
                'unidmedida_id' =>  $MaterialOP->unidMedida_id,
                'cantInfProd'  => $MaterialOP->cantidad,
                'fecha' =>  $formatreq,
                'estado' => $MaterialOP->estado
            ];
        });
        ProyectoMateriales::insert($allMaterialreqMat->toArray());
        DB::commit();
        Session::put('proyectoMaterial', collect([]));


        $ProyManoObra = Session::get('ProyManObra');
        $allRequerimientoObra = $ProyManoObra->map(function ($ProyManoObra) use ($proyectoReqMateriales) {
            return [
                'pk_proyecto_reqmateriales' => $proyectoReqMateriales->id,
                'personal' => $ProyManoObra->id_personal,
                'dias' =>  $ProyManoObra->dias,
                'horas' => $ProyManoObra->horas,
                'personalInfoProy' => $ProyManoObra->id_personal,
                'diasInfoProy' => $ProyManoObra->dias,
                'horasInfoProy' => $ProyManoObra->horas,
                'estado' => $ProyManoObra->estado 

            ];
        });
        ProyectoManObra::insert($allRequerimientoObra->toArray());
        DB::commit();
        Session::put('ProyManObra', collect([]));

        $OtrosRequerimientos = Session::get('OtrosProyReqMateriales');
        $allOtrosReque =  $OtrosRequerimientos->map(function ($OtrosRequerimientos) use ($proyectoReqMateriales) {
            return [
                'pk_proyecto_reqmateriales' => $proyectoReqMateriales->id, 
                'descripcion' => $OtrosRequerimientos->descripcion,
                'cantidad' => $OtrosRequerimientos->cantidad,
                'unidmedida_id'=> $OtrosRequerimientos->nIdUnidmed,
                'pk_tiempo_alquiler'=> $OtrosRequerimientos->nIdAlquiler,
                'descripcionInfoProy' => $OtrosRequerimientos->descripcion,
                'cantidadInfoProy' => $OtrosRequerimientos->cantidad,
                'unidmedida_idInfoProy' => $OtrosRequerimientos->nIdUnidmed,
                'estado' => $OtrosRequerimientos->estado
                
            ];
        });
        ProyectOtrosReq::insert($allOtrosReque->toArray());
        DB::commit();
        Session::put('OtrosProyReqMateriales', collect([]));


        return response()->json(['message' => 'Nuevo Requerimiento Materiales agregado', 'icon' => 'success'], 200);
    }

    public function list(Request $request){
       

        if($request->cServicio == null & $request->nIdProyecto == null  & $request->cFecha == null){
            $dato = ProyectoReqMateriales::with('ccostos')->get();
            return $dato;
        }

        //Busqueda por Fecha
        if($request->cServicio == null & $request->nIdProyecto == null ){
            $dato = ProyectoReqMateriales::with('ccostos')->where('fecha', $request->cFecha)->get();
            return $dato;
        }

           //Busqueda por Nro Servicio
           if($request->cFecha == null & $request->nIdProyecto == null ){
            $dato = ProyectoReqMateriales::with('ccostos')->where('ord_servicio', $request->cServicio)->get();
            return $dato;
        }

          //Busqueda por Proyecto
          if($request->cFecha == null & $request->cServicio == null ){
            $dato = ProyectoReqMateriales::with('ccostos')->where('centro_costos_id', $request->nIdProyecto)->get();
            return $dato;
        }


    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listPReqMateriales = json_decode($request->params['listPReqMateriales']);
        return (new PReqMaterialesExport)->setGenerarExcel($listPReqMateriales)->download('invoices.xlsx');
    }

    public function setGenerarPReqMaterialesPdf(Request $request){
        
        $idReqMateriales = $request->get("params")['id'];
        $ProyectoReqMateriales = ProyectoReqMateriales::with('ccostos')->where('id', $idReqMateriales)->first();
        
        $ProyectoMateriales = ProyectoMateriales::with('producto','producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
        ->where(
            ['pk_proyecto_reqmateriales' => $idReqMateriales],
            ['estado' => 'R'])
       ->get();
      
       
      
        $ProyectoManObra = ProyectoManObra::where('pk_proyecto_reqmateriales', $idReqMateriales)->where('estado', 'R')->get();
        $ProyectOtrosReq = ProyectOtrosReq::where('pk_proyecto_reqmateriales', $idReqMateriales)->where('estado', 'R')->get();
        $logo = asset('img/logo.gif');


        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.proyecto.ProyectoReqMateriales', [
            'logo' => $logo,
            'ProyectoReqMateriales' => $ProyectoReqMateriales,
            'ProyectoMateriales' => $ProyectoMateriales,
            'ProyectoManObra' => $ProyectoManObra,
            'ProyectOtrosReq' => $ProyectOtrosReq,
        ]);
        return $pdf->download('invoice.pdf');
    }
}
