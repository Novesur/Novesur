<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Session;

class DetalleCotizacionController extends Controller
{
    public function listProdByName(Request $request){
        $nIdprod = $request->nIdUsuario;

        $nIdprod = ($nIdprod == NULL) ? ($nIdprod = '') : $nIdprod;
        $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'estado','homologacion')->get();
    return $dato;
    }

    public function addItemsTemp(Request $request){



    }

    public function calculaTotal(){

    }
}
