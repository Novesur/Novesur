<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\InformeValorizacion;
use App\ProyectoReqMateriales;
use App\valorizacionManoObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InformeValorizacionManoObraController extends Controller
{


    public function CleanProyectManObra()
    {
        Session::put('InfoValorManObra', null);
        $dato = session()->get('InfoValorManObra') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorderReqManObra(Request $request)
    {
        $infoValorManoObra = valorizacionManoObra::where('id', $request->item)->first();
        $infoValorManoObra->delete();
    }
    public function ListValorMaNObraxInfoValor(Request $request)
    {
        $dato = valorizacionManoObra::with('personal')->where('pk_informe_valorizacion', $request->pk_informe_valorizacion)->get();
       
        return $dato;
    }

    public function listInfoValorManoObra(Request $request)
    {
        $idproyReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->first();
        $InformeValorizacion = InformeValorizacion::where('pk_proyecto_reqmateriales', $idproyReqMateriales->id)->first();
        $dato = valorizacionManoObra::with('personal')->where('pk_informe_valorizacion', $InformeValorizacion->id)->get();
        return $dato;
    }

    public function ListValorMaNObraxId(Request $request){
        $dato = valorizacionManoObra::where('id', $request->item)->first();
        return $dato;
    }

    public function EditOtrosReqPersonal(Request $request){
        
        valorizacionManoObra::where('id', $request->itemStorage)->update(['personal_id' => $request->nidPersonalModal]);

    }
}
