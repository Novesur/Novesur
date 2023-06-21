<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Producto;
use App\TempValorizacionMateriales;
use App\UnidMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InformeValorizacionMaterialesController extends Controller
{
    public function addReqMatInfoValor(Request $request)
    {

        $product = Producto::where(['id' => $request->nIdmaterial])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('InfoValorMaterial');
        $products = ($products != null) ? collect($products) : collect([]);

        $unidMedida = UnidMedida::where('id', $request->nIdUnidMedMat)->first();

        if ($request->cCantMaterial == 0) {
            return response()->json(['message' => 'El valor no puede ser cero', 'icon' => 'error'], 200);
        }


        $exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $tempOrder = new TempValorizacionMateriales();
            $tempOrder->fill(['cantidad' => $request->cCantMaterial,  'codigo' => $product->codigo, 'producto_id' => $request->nIdmaterial,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre, 'unidMedida' => $unidMedida->nombre, 'unidMedida_id' => $unidMedida->id, 'estado' => $request->estado]);
            $products->push($tempOrder);
            Session::put('InfoValorMaterial', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);
        endif;
    }

    public  function eliminarTemporder()
    {
        Session::put('InfoValorMaterial', null);
        $dato = session()->get('InfoValorMaterial') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorderReqMateriales(Request $request)
    {

        $id = (int)trim($request->item);
        $items = session()->get('InfoValorMaterial') ?? collect([]);
        $exits = $items->firstWhere("producto_id", $id);

        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto_id", [$id]);
            session()->put('InfoValorMaterial', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }
}
