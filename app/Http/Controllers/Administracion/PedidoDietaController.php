<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PedidoDieta;
use Carbon\Carbon;


class PedidoDietaController extends Controller
{
    public function create(Request $request){
        $date = Carbon::parse($request->dFecha)->format('Y-m-d');
        $PedidoDieta = new PedidoDieta();
        $PedidoDieta->plato_dieta_id = $request->nidPlato;
        $PedidoDieta->fecha = $date;
        $PedidoDieta->save();
        return response()->json(['message' => 'Pedido de Dieta creado', 'icon' => 'success'], 200);
    }

    public function list(Request $request){

        $date = Carbon::parse($request->dFecha)->format('Y-m-d');
        $dato = PedidoDieta::with('plato_dieta')->where('fecha', $date)->get();
            return $dato;
    }

    public function delete(Request $request){
        PedidoDieta::find($request->id)->delete();
        
    }

    public function listNow(){
        $formatreq = date("Y-m-d");
        $dato = PedidoDieta::with('plato_dieta')->where('fecha', $formatreq)->get();
            return $dato;
    }
}
