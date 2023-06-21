<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\PedidoSegundo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidoSegundoController extends Controller
{
    public function create(Request $request){
        $date = Carbon::parse($request->dFecha)->format('Y-m-d');
        $PedidoSegundo = new PedidoSegundo();
        $PedidoSegundo->plato_segundo_id = $request->nidPlato;
        $PedidoSegundo->fecha = $date;
        $PedidoSegundo->save();
        return response()->json(['message' => 'Pedido de Segundo creado', 'icon' => 'success'], 200);
    }

    public function list(Request $request){

        $date = Carbon::parse($request->dFecha)->format('Y-m-d');

        $dato = PedidoSegundo::with('plato_segundo')->where('fecha', $date)->get();
            return $dato;
    }

    public function listNow(){
        $formatreq = date("Y-m-d");
        $dato = PedidoSegundo::with('plato_segundo')->where('fecha', $formatreq)->get();
            return $dato;
    }

    public function delete(Request $request){
        PedidoSegundo::find($request->id)->delete();

    }
}
