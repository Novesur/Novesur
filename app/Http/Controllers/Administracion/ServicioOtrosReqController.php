<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\OtrosRequerimientosServicio;
use App\Servicio;
use App\ServicioInforme;
use App\ServicioInforme_OtrosRequerimientos;
use Illuminate\Http\Request;

class ServicioOtrosReqController extends Controller
{
        public function listproyOtrosReq(Request $request){


        $servicio = Servicio::where('codigo', $request->codRequMateriales)->first();
        $otrosReqServicio = OtrosRequerimientosServicio::where('pk_Servicios', $servicio->id)->first();
        $servicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();

        $countServOtrosReq = ServicioInforme_OtrosRequerimientos::where('pk_servicio_informe', $servicioInforme->id)->get();


        if ($countServOtrosReq->count() == 0) {
            $servicioInforme_OtrosRequerimientos = new ServicioInforme_OtrosRequerimientos();
            $servicioInforme_OtrosRequerimientos->pk_servicio_informe = $servicioInforme->id;
            $servicioInforme_OtrosRequerimientos->descripcion = $otrosReqServicio->descripcion;
            $servicioInforme_OtrosRequerimientos->cantidad = $otrosReqServicio->cantidad;
            $servicioInforme_OtrosRequerimientos->precio = 0;
            $servicioInforme_OtrosRequerimientos->alquiler = 0;
            $servicioInforme_OtrosRequerimientos->pk_tiempo_alquiler =1;
            $servicioInforme_OtrosRequerimientos->unidmedida_id = $otrosReqServicio->unidmedida_idInfoValor;
            $servicioInforme_OtrosRequerimientos->total =0;
            $servicioInforme_OtrosRequerimientos->save();
        }
            $dato = ServicioInforme_OtrosRequerimientos::with('unidmedida')->where('pk_servicio_informe', $servicioInforme->id)->get();
            return $dato;
    }

        public function  addReqMatProyOtrosReq(Request $request){

        $validaServicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();
        $servicioOtrosReq  = new ServicioInforme_OtrosRequerimientos();
        $servicioOtrosReq ->pk_servicio_informe = $validaServicioInforme->id;
        $servicioOtrosReq ->descripcion = mb_strtoupper($request->cDescripcion);
        $servicioOtrosReq ->cantidad = $request->cCantidadReq;
        $servicioOtrosReq->precio = 0;
        $servicioOtrosReq->alquiler = 0;
        $servicioOtrosReq->pk_tiempo_alquiler =1;
        $servicioOtrosReq->unidmedida_id = $request->nIdUnidMedOtrosReq;
        $servicioOtrosReq->total =0;
        $servicioOtrosReq ->save();
    }

       public function reorderOtrosReq(Request $request){
        $otrosRequerimientosServicio = ServicioInforme_OtrosRequerimientos::where('id',$request->item)->first();
        $otrosRequerimientosServicio->delete();
    }

       public function ListValorOtrosReqxServicio(Request $request){

        $servicioInforme = ServicioInforme::where('id', $request->pk_Servicios)->first();
        $dato = ServicioInforme_OtrosRequerimientos::with('unidmedida')->where('pk_servicio_informe', $servicioInforme->id)->get();
        return $dato;

    }

          public function mostrarInfoManObra(Request $request)
    {
        $datos = ServicioInforme_OtrosRequerimientos::with('unidmedida')->where('pk_servicio_informe', $request->item)->get();
        return $datos;
    }

}
