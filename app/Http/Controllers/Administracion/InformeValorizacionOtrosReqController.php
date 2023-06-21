<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\TempValorizacionOtrosRequerimientos;
use App\TiempoAlquiler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InformeValorizacionOtrosReqController extends Controller
{
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
        $id = trim($request->item);
        $items = session()->get('OtrosProyInfoValor') ?? collect([]);
        $exits = $items->firstWhere("descripcion", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("descripcion", [$id]);
            session()->put('OtrosProyInfoValor', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);

    }
}
