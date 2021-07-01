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
}
