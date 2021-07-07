<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Familia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;

class ProductoController extends Controller
{

    public function index(Request $request)

    {

        if ($request->nIdFamilia == null && $request->nIdSubFamilia == null && $request->nIdMarca == null && $request->nIdMaterial == null && $request->nIdEstado == null && $request->nIdHomologado == null && $request->nIdCodigo == null) {
            $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion', 'estado')->orderBy('codigo', 'ASC')->get();
        } else {
            $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion', 'estado')
                ->orWhere('familia_id', $request->nIdFamilia)
                ->orWhere('subfamilia_id', $request->nIdSubFamilia)
                ->orWhere('marca_id', $request->nIdMarca)
                ->orWhere('material_id', $request->nIdMaterial)
                ->orWhere('estado_id', $request->nIdEstado)
                ->orWhere('codigo', $request->nIdCodigo)
                ->orWhere('homologacion_id', $request->nIdHomologado)->orderBy('codigo', 'DESC')->get();
        }
        return $dato;
    }

    public function create(Request $request)
    {
        $producto = new Producto;
        if ($request->nIdHomologado == 2) {
            $codiprod = $request->codiprodcert;
        } else {
            $codiprod = $request->codiprod;
        }
        $cons = Producto::where('codigo', '=', $codiprod)->exists();
        if ($cons) {
            return response()->json(['message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        } else {
            $producto->codigo = mb_strtoupper($request->nIdCodigo);
            $producto->familia_id = $request->nIdFamilia;
            $producto->subfamilia_id = $request->nIdSubFamilia;
            $producto->modelotipo_id = $request->nIdModeloTipo;
            $producto->marca_id = $request->nIdMarca;
            $producto->material_id = $request->nIdMaterial;
            $producto->estado_id = $request->nIdEstado;
            $producto->user_id = $request->nIdUser;
            $producto->homologacion_id = $request->nIdHomologado;
            $producto->save();
            return response()->json(['message' => 'Producto grabado', 'icon' => 'success'], 200);
        }
    }



    public function ListarProductoById(Request $request)
    {
        $dato = Producto::where('id', '=', $request->nIdProducto)->first();
        return $dato;
    }

    public function ListarProductoByIdKardex(Request $request)
    {
        $dato = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion', 'estado')
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
            $Producto->codigo = mb_strtoupper($request->nIdCodigo);
            $Producto->familia_id = $request->nIdFamilia;
            $Producto->subfamilia_id = $request->nIdSubFamilia;
            $Producto->modelotipo_id = $request->nIdModeloTipo;
            $Producto->marca_id = $request->nIdMarca;
            $Producto->material_id = $request->nIdMaterial;
            $Producto->estado_id = $request->nIdEstado;
            $Producto->user_id = $request->nIdUser;
            $Producto->homologacion_id = $request->nIdHomologado;
            $Producto->save();
        }

    }


    public function BuscaCodigoProducto(Request $request)
    {

        $nIdCodigo = $request->nIdCodigo;
        if (Producto::where('codigo', $nIdCodigo)->exists()) {
            return response()->json(['message' => 'El codigo del producto ya existe', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'Codigo de producto no usado', 'icon' => 'success'], 200);
        }
    }

    public function export(Request $request)
    {


        // dd($request->params['listProductos']);
        $listproductos = json_decode($request->params['listProductos']);



        return (new ProductsExport)->setGenerarExcel($listproductos)->download('invoices.xlsx');
    }
}
