<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\InformeValorizacion;
use App\ProyectoReqMateriales;
use App\TempValorizacionManObra;
use App\valorizacionManoObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InformeValorizacionManoObraController extends Controller
{
    public function addInfoValorManObra(Request $request)
    {

        $materiales = Session::get('InfoValorManObra');
        $materiales = ($materiales != null) ? collect($materiales) : collect([]);
        $tempMatOrdenMaterial = new TempValorizacionManObra();
        $tempMatOrdenMaterial->fill(['personal' => mb_strtoupper($request->cPersonal), 'dias' => $request->cDiasMObra, 'horas' => $request->cHorasMObra, 'estado' => $request->estado]);
        $materiales->push($tempMatOrdenMaterial);
        Session::put('InfoValorManObra', $materiales);
        return response()->json(['datos' => $materiales, 'message' => NULL]);
    }

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
}
