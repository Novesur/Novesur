<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Familia;


class ProductoController extends Controller
{

    public function index(Request $request)

    {
        $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'estado')
            ->orWhere('familia_id', $request->nIdFamilia)
            ->orWhere('subfamilia_id', $request->nIdSubFamilia)
            ->orWhere('marca_id', $request->nIdMarca)
            ->orWhere('material_id', $request->nIdMaterial)
            ->orWhere('estado_id', $request->nIdEstado)
            ->get();
        return $dato;
    }

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = new Producto;
        $producto->codigo = $request->codiprod;
        $producto->familia_id = $request->nIdFamilia;
        $producto->subfamilia_id = $request->nIdSubFamilia;
        $producto->modelotipo_id = $request->nIdModeloTipo;
        $producto->marca_id = $request->nIdMarca;
        $producto->material_id = $request->nIdMaterial;
        $producto->estado_id = $request->nIdEstado;
        $producto->user_id = $request->nIdUser;
        $producto->save();
    }

    public function ListarProductoById(Request $request)
    {
        $dato = Producto::where('id', '=', $request->nIdProducto)->first();
        return $dato;
    }

    public function ListarProductoByIdKardex(Request $request)
    {
        $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'estado')
            ->where('id', '=', $request->nIdProducto)->first();
        return $dato;
    }

    public function ListarSubfamiliabyFamilia(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $dato = Familia::where('nombre', 'like', '%' . $cNombre . '%')->get();
        return $dato;
    }

    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdProducto = $request->nIdProducto;
        $Producto = Producto::where('id', $nIdProducto)->first();
        if ($Producto) {
            $Producto->codigo = $request->codiprod;
            $Producto->familia_id = $request->nIdFamilia;
            $Producto->subfamilia_id = $request->nIdSubFamilia;
            $Producto->modelotipo_id = $request->nIdModeloTipo;
            $Producto->marca_id = $request->nIdMarca;
            $Producto->material_id = $request->nIdMaterial;
            $Producto->estado_id = $request->nIdEstado;
            $Producto->user_id = $request->nIdUser;

            $Producto->save();
        }
    }
}
