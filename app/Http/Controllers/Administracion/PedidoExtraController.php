<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\PedidoExtra;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidoExtraController extends Controller
{
    public function create(Request $request){
        $date = Carbon::parse($request->dFecha)->format('Y-m-d');
        $PedidoExtra = new PedidoExtra();
        $PedidoExtra->plato_extra_id = $request->nidPlato;
        $PedidoExtra->fecha = $date;
        $PedidoExtra->save();
        return response()->json(['message' => 'Pedido de Extra creado', 'icon' => 'success'], 200);
    }

    public function list(Request $request){

        $date = Carbon::parse($request->dFecha)->format('Y-m-d');

        $dato = PedidoExtra::with('plato_extra')->where('fecha', $date)->get();
            return $dato;
    }

    public function listNow(){
        $formatreq = date("Y-m-d");
        $dato = PedidoExtra::with('plato_extra')->where('fecha', $formatreq)->get();
            return $dato;
    }

    public function delete(Request $request){
        PedidoExtra::find($request->id)->delete();

    }
}
