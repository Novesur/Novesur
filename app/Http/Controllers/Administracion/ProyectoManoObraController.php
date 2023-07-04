<?php

namespace App\Http\Controllers\Administracion;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Personal;
use App\ProyectoManObra;
use App\ProyectoReqMateriales;
use App\TempProyectoManObra;
use Illuminate\Http\Request;

class ProyectoManoObraController extends Controller
{
    public function addProyManObra(Request $request)
    {
       
        $personal= Personal::where('id',$request->nIdPersonal)->first();
        $materiales = Session::get('ProyManObra');
        $materiales = ($materiales != null) ? collect($materiales) : collect([]);
        $tempMatOrdenMaterial = new TempProyectoManObra();
        $tempMatOrdenMaterial->fill(['id_personal' => $personal->id,'personal_nombres' => mb_strtoupper($personal->nombres),'personal_paterno' => mb_strtoupper($personal->ApPaterno),'personal_materno' => mb_strtoupper($personal->ApMaterno), 'dias' => $request->cDiasMObra, 'horas' => $request->cHorasMObra,'estado' => $request->estado ]);
        $materiales->push($tempMatOrdenMaterial);
        Session::put('ProyManObra', $materiales);
        return response()->json(['datos' => $materiales, 'message' => NULL]);

    }

    public function CleanProyectManObra()
    {
        Session::put('ProyManObra', null); 
        $dato = session()->get('ProyManObra') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorderProyectManObra(Request $request){
        $id = trim($request->item);
        $items = session()->get('ProyManObra') ?? collect([]);
        $exits = $items->firstWhere("id_personal", $id);
        
        if (!empty($exits)) :
            $items =  $items->whereNotIn("id_personal", [$id]);
            session()->put('ProyManObra', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);

    }

/*     public function listproyManoObra(Request $request){
        $idproyReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->first();
        $dato = ProyectoManObra::with('personal','personalInfoProy')->where('pk_proyecto_reqmateriales', $idproyReqMateriales->id)->get(); 
        return $dato;
    } */

}
