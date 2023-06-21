<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\PedidoEntrada;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidoEntradaController extends Controller
{
    public function create(Request $request){
        $date = Carbon::parse($request->dFecha)->format('Y-m-d');
        $PedidoEntrada = new PedidoEntrada();
        $PedidoEntrada->plato_entrada_id = $request->nidPlato;
        $PedidoEntrada->fecha = $date;
        $PedidoEntrada->save();
        return response()->json(['message' => 'Pedido de Entrada creado', 'icon' => 'success'], 200);
    }

    public function list(Request $request){

        $date = Carbon::parse($request->dFecha)->format('Y-m-d');
      

        $dato = PedidoEntrada::with('plato_entrada')->where('fecha', $date)->get();
      
            return $dato;
    }

    public function listNow(){
        $formatreq = date("Y-m-d");
        $dato = PedidoEntrada::with('plato_entrada')->where('fecha', $formatreq)->get();
            return $dato;
    }

    public function delete(Request $request){
        PedidoEntrada::find($request->id)->delete();
        

    }
}
