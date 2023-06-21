<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;
use App\TempValorizacionManObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InformeValorizacionManoObraController extends Controller
{
    public function addInfoValorManObra(Request $request)
    {
       
        $materiales = Session::get('InfoValorManObra');
        $materiales = ($materiales != null) ? collect($materiales) : collect([]);
        $tempMatOrdenMaterial = new TempValorizacionManObra();
        $tempMatOrdenMaterial->fill(['personal' => mb_strtoupper($request->cPersonal), 'dias' => $request->cDiasMObra, 'horas' => $request->cHorasMObra,'estado' => $request->estado ]);
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

    public function reorderReqManObra(Request $request){
        $id = trim($request->item);
        $items = session()->get('InfoValorManObra') ?? collect([]);
        $exits = $items->firstWhere("personal", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("personal", [$id]);
            session()->put('InfoValorManObra', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);

    }
}
