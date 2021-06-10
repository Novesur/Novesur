<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordencompra;
use App\Http\Controllers\Controller;
use App\Ordencompra;
use App\Producto;
use App\TempOrdenCompra;
use App\UnidMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdencompraController extends Controller
{
    public function addOrden(Request $request){
        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);
        $exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);

        else :
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $tempOrder = new TempOrdenCompra;
            $tempOrder->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPrecio, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($tempOrder);
            Session::put('products', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);

        endif;
    }

    public  function ListtempOrden()
    {
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function eliminarTemporder()
    {
        Session::put('products', null);
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function create(Request $request)
    {



   /*      if ($request->session()->has('products')) {



            $formatreq = date("Y-m-d");
            $ordenCompra = new Ordencompra();
            $ordenCompra->fecha =  $formatreq;
            $ordenCompra->cliente_id =  $request->nIdCliente;
            $ordenCompra->user_id =  $request->nIdUsuario;
            $ordenCompra->estadopedido_id =  $request->cEstado;
            $ordenCompra->validezoferta =  $request->cValidez;
            $ordenCompra->Entrega =  mb_strtoupper($request->cEntrega);
            $ordenCompra->tipopago_id =  $request->nIdTipoPago;
            $ordenCompra->pago_id = $request->nIdDescripPago;
            $ordenCompra->flete =  $request->cFlete;
            $ordenCompra->documentacion =  $request->Docu;
            $ordenCompra->garantia_id =  $request->nIdGarantia;
            $ordenCompra->punto_llegada =  $request->cPuntoLlegada;
            $ordenCompra->transporte =  $request->cTransporte;
            $ordenCompra->consignado =  $request->Cconsignado;

            $ordenCompra->save();
            $detordenCompra = Session::get('products');

            $allProducts = $detordenCompra->map(function ($product) use ($ordenCompra) {
                return [
                    'ordenCompra_id' => $ordenCompra->id,
                    'cantidad'      => $product->cantidad,
                    'unidmedida_id' => $product->unidmedida_id,
                    'producto_id'   => $product->producto_id,
                    'punit'         => $product->punit,
                ];
            });
            Detalleordencompra::insert($allProducts->toArray());
            Session::put('products', collect([]));
            return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
        } else {
            return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
        } */
    }

}
