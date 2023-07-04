<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\ProyectoReqMateriales;
use App\ProyectOtrosReq;
use App\TempProyectOtrosRequerimientos;
use App\UnidMedida;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProyectOtrosReqController extends Controller
{
    public function addOtrosProyReqMateriales(Request $request)
    {
        $Unidmed = UnidMedida::where('id',$request->nIdUnidMedOtroReq)->first();
        $requerimientos = Session::get('OtrosProyReqMateriales');
        $requerimientos = ($requerimientos != null) ? collect($requerimientos) : collect([]);
        if($request->cCantidadReq == 0 || null ){
            return response()->json(['message' => 'El valor no puede ser cero ni vacio', 'icon' => 'error'], 200);
        }
        $tempRequerimientos = new TempProyectOtrosRequerimientos();
        $tempRequerimientos->fill(['descripcion' => mb_strtoupper($request->cDescripcion), 'cantidad' => mb_strtoupper($request->cCantidadReq),'estado'=> $request->estado,'cCantAlq'=>$request->cCantAlq,'cPrecioReq'=>$request->cPrecioReq,'nIdUnidmed'=>$request->nIdUnidMedOtroReq,'NomUnidmed'=>$Unidmed->nombre]);
        $requerimientos->push($tempRequerimientos);
        Session::put('OtrosProyReqMateriales', $requerimientos);
        return response()->json(['datos' => $requerimientos, 'message' => NULL]); 
    }

    public function CleanOtrosProyReqMateriales()
    {
        Session::put('OtrosProyReqMateriales', null); 
        $dato = session()->get('OtrosProyReqMateriales') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorderOtrosReq(Request $request){
        $id = trim($request->item);
        $items = session()->get('OtrosProyReqMateriales') ?? collect([]);
        $exits = $items->firstWhere("descripcion", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("descripcion", [$id]);
            session()->put('OtrosProyReqMateriales', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);

    } 


/*     public function listproyOtrosReq(Request $request){ 
       
        $idproyReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->first();
        $dato = ProyectOtrosReq::with('unidmedida_idInfoProy')->where('pk_proyecto_reqmateriales', $idproyReqMateriales->id)->get(); 
        return $dato; 

    } */

}
