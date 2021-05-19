<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\DetalleCotizacion;
use App\EstadoPedido;

class DetalleCotizacionController extends Controller
{
    public function listProdByName(Request $request)
    {
        $nIdprod = $request->nIdUsuario;
        $nIdprod = ($nIdprod == NULL) ? ($nIdprod = '') : $nIdprod;
        $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'estado', 'homologacion')->get();
        return $dato;
    }



    public function listDetCotizacionBy(Request $request)
    {
        $dato = DetalleCotizacion::with('unidmedida','producto','producto.marca','producto.familia','producto.material','producto.modelotipo','producto.subfamilia','producto.homologacion')->where('cotizacion_id', $request->item)->get();
        return $dato;
    }



    public function listEstadoCotizacion(){
        $dato = EstadoPedido::all();
        return $dato ;
    }

    public function CotizacionToPdf(Request $request){
        $dato = DetalleCotizacion::with('cliente', 'user', 'tipopago', 'estadopedido')->whereBetween('id', [$request->nidCoti])->get();
        return $request;

    }


}
