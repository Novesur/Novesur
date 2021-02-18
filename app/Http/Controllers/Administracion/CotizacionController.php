<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Tipopago;
use App\UnidMedida;
use App\TempCotizacion;


class CotizacionController extends Controller
{
    public function addTempCotizacion(Request $request)
    {
        $formatreq = date("Y-m-d");
        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);
        $exists = null;
        if (count($products) > 0) :
            $exists = $products->first(function ($product_new) use ($product) {
                if ((int)$product_new->idproduct == $product->id) :
                    return $product_new;
                endif;
            });
        endif;
        if ($exists != null) :
            return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
        else :
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $tipopago = Tipopago::where(['id' => $request->nIdTipoPago])->first();
            $tempcotizacion = new TempCotizacion;
            $tempcotizacion->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'producto_id' => $request->nIdprod, 'punit' => $request->cPUnit, 'total' => $request->cTotal, 'validezoferta' => $request->cValidez, 'Entrega' => $request->cEntrega, 'tipopago_id' => $request->nIdTipoPago, 'descripcionTipopago' => $request->cFPago, 'flete' => $request->cFlete, 'documentacion' => $request->Docu, 'garantia' => $request->cGarantia, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'tipopagoNombre' => $tipopago->nombre]);
            $products->push($tempcotizacion);
            Session::put('products', $products);
            //return response()->json("Grabado");
            return   $products;
        endif;
    }
    public  function ListtempCotizacion(Request $request)
    {
        $dato = session()->get('products') ?? [];
        return response()->json(['datos' => $dato]);
    }

    public function listTipoPago()
    {
        $dato = Tipopago::all();
        return $dato;
    }

    public function eliminarTempitemCoti(){
        Session::put('products', null);
        $dato = session()->get('products') ?? [];
        return response()->json(['datos' => $dato]);

    }

    public function reorder(Request $request)
    {

        $items = session()->get('products') ?? [];
        $exits = FALSE;
        foreach ($items as $key => $item) :
            if (trim($item->id) === trim($request->item)) :
                $exits = true;
                unset($items[$key]);
            endif;
        endforeach;
        if ($exits === FALSE) :
            return response()->json(['message' => 'El item no existe'], 422);
        endif;
        $items = array_values($items);
        session()->put('products', $items);
        return response()->json(['datos' => $items]);
    }
}
