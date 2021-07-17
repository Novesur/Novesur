<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordencompra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetalleOrdenCompraController extends Controller
{
    public function view(Request $request){

        $dato = Detalleordencompra::with('ordencompras','unidmedida','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('ordencompras_id', $request->item)->get();
        return $dato;
    }

    public function CambiarEstadoDetalleOC(Request $request){
        $DetalleOC = Detalleordencompra::where('id',$request->nIdDetalleOC)->first();
        if($DetalleOC){
            $DetalleOC->ordencompras_id = $DetalleOC->ordencompras_id;
            $DetalleOC->producto_id = $DetalleOC->producto_id;
            $DetalleOC->cantidad = $DetalleOC->cantidad;
            $DetalleOC->unidmedida_id = $DetalleOC->unidmedida_id;
            $DetalleOC->punit = $DetalleOC->punit;
            $DetalleOC->estado = $request->cEstado;
            $DetalleOC->save();
        }




    }
}
