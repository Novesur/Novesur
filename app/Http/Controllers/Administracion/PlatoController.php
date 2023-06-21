<?php

namespace App\Http\Controllers\Administracion;

use App\DetallePlato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\PedidoExtra;
use App\PedidoSegundo;
use App\PedidoEntrada;
use App\PedidoDieta;
use App\PlatoEntrada;
use App\PlatoDieta;
use App\PlatoSegundo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlatoController extends Controller
{
    public function CrearPlatoEntrada(Request $request)
    {
        $platoEntCount = PlatoEntrada::where('nombre', $request->cNomEntrada)->count();

        if ($platoEntCount <=  0) {
            $platoEntrada = new PlatoEntrada;
            $platoEntrada->nombre = mb_strtoupper(trim($request->cNomEntrada));
            $platoEntrada->estado = 'A';
            $platoEntrada->save();
            return response()->json(['message' => 'Plato Entrada Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Entrada ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function getDataPlato(Request $request)
    {
        if ($request->tipo == 'ent') {
            $dato = PlatoEntrada::find($request->item);
            return $dato;
        }

        if ($request->tipo == 'seg') {
            $dato = PlatoSegundo::find($request->item);
            return $dato;
        }
        if ($request->tipo == 'ext') {
            $dato = PlatoExtra::find($request->item);
            return $dato;
        }
        if ($request->tipo == 'diet') {
            $dato = PlatoDieta::find($request->item);
            return $dato;
        }
    }

    public function EditPlatoEntrada(Request $request)
    {
        $platoEntrada = PlatoEntrada::where('id', $request->item)->first();
        $platoEntrada->nombre = $request->cNomPlato;
        $platoEntrada->estado = 'A';
        $platoEntrada->save();
    }

    public function EditPlatoSegundo(Request $request)
    {
        $platosegundo = PlatoSegundo::where('id', $request->item)->first();
        $platosegundo->nombre = $request->cNomPlato;
        $platosegundo->estado = 'A';
        $platosegundo->save();
    }

    public function EditExtra(Request $request)
    {
        $platoextra = PlatoExtra::where('id', $request->item)->first();
        $platoextra->nombre = $request->cNomPlato;
        $platoextra->estado = 'A';
        $platoextra->save();
    }

    public function EditDieta(Request $request){ 
        $platodieta = PlatoDieta::where('id', $request->item)->first();
        $platodieta->nombre = $request->cNomPlato;
        $platodieta->estado = 'A';
        $platodieta->save();
    }

    public function DeletePlatoEntrada(Request $request)
    {

       
        
        $platoEntrada = PlatoEntrada::where('id', $request->item)->first();
        $pedidoentrada = PedidoEntrada::where('plato_entrada_id', $platoEntrada->id)->get();
            foreach ($pedidoentrada as $dataReq) {
                $dataReq->delete();
        }
        
        $platoEntrada->delete();
    }

    public function DeletePlatoSegundo(Request $request)
    {
        $platoSegundo = PlatoSegundo::where('id', $request->item)->first();
        $pedidoSegundo = PedidoSegundo::where('plato_segundo_id', $platoSegundo->id)->get();

        foreach ($pedidoSegundo as $dataReq) {
            $dataReq->delete();
        }
        $platoSegundo->delete();
    }

    public function DeletePlatoExtra(Request $request)
    {

        $platoExtra = PlatoExtra::where('id', $request->item)->first();
        $pedidoExtra = PedidoExtra::where('plato_extra_id', $platoExtra->id)->get();

        foreach ($pedidoExtra as $dataReq) {
            $dataReq->delete();
        }
        $platoExtra->delete();
    }

    public function DeletePlatoDieta(Request $request){
  
        $platoDieta = PlatoDieta::where('id', $request->item)->first();
      
         $pedidoDieta= PedidoDieta::where('plato_dieta_id', $platoDieta->id)->get();
        foreach ($pedidoDieta as $dataReq) {
            $dataReq->delete();
        } 
        $platoDieta->delete();
    }


    public function CrearPlatoSegundo(Request $request)
    {
        $platoSegCount = PlatoSegundo::where('nombre', $request->cNomSegundo)->count();

        if ($platoSegCount <=  0) {
            $platoSegundo = new PlatoSegundo();
            $platoSegundo->nombre = mb_strtoupper(trim($request->cNomSegundo));
            $platoSegundo->estado = 'A';
            $platoSegundo->save();
            return response()->json(['message' => 'Plato Segundo Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Segundo ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function CrearPlatoExtra(Request $request)
    {
        $platoExtCount = PlatoExtra::where('nombre', $request->cNomExtra)->count();

        if ($platoExtCount <=  0) {
            $platoExtra = new PlatoExtra();
            $platoExtra->nombre = mb_strtoupper(trim($request->cNomExtra));
            $platoExtra->estado = 'A';
            $platoExtra->save();
            return response()->json(['message' => 'Plato Extra Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Extra ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function getListarPEntrada(Request $request)
    {
        $dato = DB::table('plato_entrada')
        ->where('nombre', 'like', '%'. $request->cNombre .'%')
        ->whereNull('deleted_at')
        ->get();
        return $dato;


    }

    public function getListarPSegundo(Request $request)
    {
        $dato = DB::table('plato_segundo')
                ->where('nombre', 'like', '%'. $request->cNombre .'%')
                ->whereNull('deleted_at')
                ->get();
                return $dato;
    }

    public function getListarPExtra(Request $request)
    {
        $dato = DB::table('plato_extra')
        ->where('nombre', 'like', '%'. $request->cNombre .'%')
        ->whereNull('deleted_at')
        ->get();
        return $dato;
    }

    public function getListarPDieta(Request $request){
        $dato = DB::table('plato_dieta')
        ->where('nombre', 'like', '%'. $request->cNomDieta .'%')
        ->whereNull('deleted_at')
        ->get();
        return $dato;
    }


    public function CreateDetallePlato(Request $request)
    {

        $detallePlato = new DetallePlato;
        $detallePlato->plato_id = $request->nidPlato;
        $detallePlato->tipoplato_id = $request->tipoPlato;
        $detallePlato->fecha =  Carbon::parse($request->dFecha)->format('Y-m-d');
        $detallePlato->save();
        return response()->json(['message' => 'Pedido de plato agregado', 'icon' => 'info'], 200);
    }

    public function listEntrada()
    {
        $dato = PlatoEntrada::where('estado', 'A')->get();
        return $dato;
    }

    public function CrearPlatoDieta(Request $request)
    {
        $platoDietaCount = PlatoDieta::where('nombre', $request->cNomDieta)->count();

        if ($platoDietaCount <=  0) {
            $platoExra = new PlatoDieta();
            $platoExra->nombre = mb_strtoupper(trim($request->cNomDieta));
            $platoExra->estado = 'A';
            $platoExra->save();
            return response()->json(['message' => 'Plato Segundo Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Segundo ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function listSegundo()
    {
        $dato = PlatoSegundo::where('estado', 'A')->get();
        return $dato;
    }

    public function listExtra()
    {
        $dato = PlatoExtra::where('estado', 'A')->get();
        return $dato;
    }

    public function listDieta()
    {
        $dato = PlatoDieta::where('estado', 'A')->get();
        return $dato;
    }
}
