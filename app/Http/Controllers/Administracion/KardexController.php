<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kardex;

class KardexController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdProducto = $request->nIdProducto;
        $nIdProducto = ($nIdProducto == NULL) ? ($nIdProducto = '') : $nIdProducto;
        $dato = Kardex::where('producto_id',  $nIdProducto)->first();
        return $dato;
    }

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $kardex = new Kardex;
        $kardex->producto_id =  $request->nidProducto;
        $kardex->stock =  $request->cStock;
        $kardex->costunit = $request->cCostUnit;
        $kardex->diferencia =  $request->cDiferencia;
        $kardex->save();
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdProducto = $request->nIdProducto;
        $nIdProducto = ($nIdProducto == NULL) ? ($nIdProducto = '') : $nIdProducto;
        $dato = Kardex::with(['producto.marca','producto.familia', 'producto.subfamilia', 'producto.modelotipo', 'producto.material','producto.user.almacen'])
            ->where('producto_id', $request->nIdProducto)->get();
        return $dato;
    }

    public function BuscaStockxProducto(Request $request){
        $datos = Kardex::where('producto_id', $request->nIdprod)->first();
        return $datos;
    }




}
