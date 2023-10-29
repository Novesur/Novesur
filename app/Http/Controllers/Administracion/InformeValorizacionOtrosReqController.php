<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\InformeValorizacion;
use App\ProyectoReqMateriales;
use App\ProyectOtrosReq;
use App\TempValorizacionOtrosRequerimientos;
use App\TiempoAlquiler;
use App\valorizacionOtrosReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InformeValorizacionOtrosReqController extends Controller
{



    public function listInfoValorOtrosReq(Request $request){

        $idproyReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->first();
        $InformeValorizacion = InformeValorizacion::where('pk_proyecto_reqmateriales', $idproyReqMateriales->id)->first();
        $dato = valorizacionOtrosReq::with('unidmedida')->where('pk_informe_valorizacion', $InformeValorizacion->id)->get();
        return $dato;
}


     public function addOtrosProyInfoValor(Request $request)
    {

        $requerimientos = Session::get('OtrosProyInfoValor');
        $nombreTiempo = TiempoAlquiler::where('id',$request->nIdAlquiler)->first();
        $requerimientos = ($requerimientos != null) ? collect($requerimientos) : collect([]);
        if($request->cCantidadReq == 0 || null ){
            return response()->json(['message' => 'El valor no puede ser cero ni vacio', 'icon' => 'error'], 200);
        }
        $tempRequerimientos = new TempValorizacionOtrosRequerimientos();
        $tempRequerimientos->fill(['descripcion' => mb_strtoupper($request->cDescripcion), 'cantidad' => mb_strtoupper($request->cCantidadReq),'estado'=> $request->estado,'cCantAlq'=> $request->cCantAlq,'AlquilerNombre'=> $nombreTiempo->nombre,'idAlquiler'=>$request->nIdAlquiler,'precioOtros'=>$request->precioOtros]);
        $requerimientos->push($tempRequerimientos);
        Session::put('OtrosProyInfoValor', $requerimientos);
        return response()->json(['datos' => $requerimientos, 'message' => NULL]);
    }

    public function CleanOtrosProyInfoValor()
    {
        Session::put('OtrosProyInfoValor', null);
        $dato = session()->get('OtrosProyInfoValor') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorderOtrosReq(Request $request){


        $proyectOtrosReq = ProyectOtrosReq::where('id',$request->item)->first();
        $proyectOtrosReq->delete();

    }


    public function ListValorOtrosReqxInfoValor(Request $request){
        $dato = valorizacionOtrosReq::with('unidmedida')->where('pk_informe_valorizacion', $request->pk_informe_valorizacion)->get();
        return $dato;

    }



}
