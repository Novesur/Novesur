<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordencompra;
use App\Http\Controllers\Controller;
use App\Ordencompra;
use App\Producto;
use App\User;
use App\TempOrdenCompra;
use App\Tipocambio;
use App\UnidMedida;
use App\Proveedor;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Exports\ListPrecprodExport;
use App\Exports\ListPrecprovExport;
use App\Countable;
use App\TipOrdenCompra;

class OrdencompraController extends Controller
{

    public function edit(Request $request){

        $ordenCompra = Ordencompra::where('codigo', $request->nidOrdenCompra)->first();
        $proveedor = Proveedor::where('id', $ordenCompra->proveedor_id)->first();
        $ordenCompra->codigo = $ordenCompra->codigo;
        $ordenCompra->Femision = $ordenCompra->Femision;
        $ordenCompra->Referencia = $ordenCompra->Referencia;
        $ordenCompra->proveedor_id = $ordenCompra->proveedor_id;
        $ordenCompra->Fentrega = $ordenCompra->Fentrega;
        $ordenCompra->LugarEntrega = $request->cLEntrega;
        $ordenCompra->pago_id = $request->nIdTipoPago;
        $ordenCompra->user_id = $ordenCompra->user_id;
        $ordenCompra->estadoordencompra_id = $ordenCompra->estadoordencompra_id;
        $ordenCompra->observacion = $request->cObservacion;
        $ordenCompra->tipocambio_id = $request->nIdTipoMoneda;
        $ordenCompra->tipo_ordencompra_id = $proveedor->tipo_compra_id;
        $ordenCompra->save();

    }

    public function addOrden(Request $request)
    {
      $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);
        /*$exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);

        else : */
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $tempOrder = new TempOrdenCompra;
            $tempOrder->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPrecio, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($tempOrder);
            Session::put('products', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);

        /* endif; */
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



        $femision = date("Y-m-d", strtotime($request->cFechaEmision));
        $fentrega = date("Y-m-d", strtotime($request->cFechaEntrega));

        $usuario = User::find($request->nIdUser);




        $countableCentral = Countable::all();
        $countableCentralCount = $countableCentral[0]->countordencompra;
        $countablePiuraCount = $countableCentral[0]->countordencompraPiura;
        $countordencompra_Inter = $countableCentral[0]->countordencompra_Inter;
        $proveedor = Proveedor::where('id', $request->nIdProveedor)->first();

        if($proveedor->tipo_ordencompra_id == 1){
            if($usuario->almacen_id == 1){

                if($countableCentralCount == 0){
                    $codOrdCompra = 'OCN0001'.'-'. Carbon::parse($request->cFechaEmision)->format('Y');
                }else{
                    $codOrdCompra = 'OCN'.sprintf('%04d',$countableCentralCount +1) .'-'. Carbon::parse($request->cFechaEmision)->format('Y');
                }
            }
        }else{

            if($countordencompra_Inter == 0){
                $codOrdCompra = 'OCI0001'.'-'. Carbon::parse($request->cFechaEmision)->format('Y');
            }else{
                $codOrdCompra = 'OCI'.sprintf('%04d',$countordencompra_Inter +1) .'-'. Carbon::parse($request->cFechaEmision)->format('Y');
            }

        }

        if($usuario->almacen_id == 7){


            if($countablePiuraCount == 0){
                $codOrdCompra = 'CP0001'.'-'. Carbon::parse($request->cFechaEmision)->format('Y');
            }else{
                $codOrdCompra = 'CP'.sprintf('%04d',$countablePiuraCount +1 ) .'-'. Carbon::parse($request->cFechaEmision)->format('Y');
            }
        }


        if ($request->session()->has('products')) {
            $ordenCompra = new Ordencompra();
            $ordenCompra->codigo =  $codOrdCompra;
            $ordenCompra->Femision =  $femision;
            $ordenCompra->Referencia =  mb_strtoupper($request->cReferencia);
            $ordenCompra->proveedor_id =  $request->nIdProveedor;
            $ordenCompra->Fentrega =  $fentrega;
            $ordenCompra->LugarEntrega =  mb_strtoupper($request->cLEntrega);
            $ordenCompra->pago_id =  $request->nIdTipoPago;
            $ordenCompra->user_id =  $request->nIdUser;
            $ordenCompra->estadoordencompra_id = 2;
            $ordenCompra->observacion = $request->cObservacion;
            $ordenCompra->tipocambio_id = $request->nIdTipoMoneda;
            $ordenCompra->tipo_ordencompra_id = $request->nIdTipOrdenCompra;
            $ordenCompra->documento_enviar = $request->cDocEnvio;
            $ordenCompra->save();
            $detordenCompra = Session::get('products');
            $allProducts = $detordenCompra->map(function ($product) use ($ordenCompra) {
                return [
                    'ordencompras_id'   => $ordenCompra->id,
                    'producto_id'       => $product->producto_id,
                    'cantidad'          => $product->cantidad,
                    'cantidadKardex'    => 0,
                    'unidmedida_id'     => $product->unidmedida_id,
                    'punit'             => $product->punit,
                    'estado'            => 2,
                    'canting'            => 0,
                ];
            });

            Detalleordencompra::insert($allProducts->toArray());
            Session::put('products', collect([]));

             /*  Si el usuario es de Sede Central */
             if($request->nIdTipOrdenCompra == 1){
                 if($usuario->almacen_id == 1){
                 Countable::where('id', 1)->update(['countordencompra' => $countableCentralCount +1]);
                 }

             }else{
                if($usuario->almacen_id == 1){
                    Countable::where('id', 1)->update(['countordencompra_Inter' => $countordencompra_Inter +1]);
                    }
             }


           /*  Si el usuario es de Piura */
            if($usuario->almacen_id == 7){

                Countable::where('id', 1)->update(['countordencompraPiura' => $countablePiuraCount +1]);
                }

            return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
        } else {
            return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
        }
    }

    public function TipoCambio()
    {
        $data = Tipocambio::all();
        return $data;
    }

    public function ListXProduct(Request $request)
    {
               $nIdprod = $request->nIdprod;

               $dato =  Detalleordencompra::with('ordencompras','unidmedida','producto','ordencompras.proveedor')
                   ->whereHas('ordencompras', function (Builder $query) use ($nIdprod) {$query->where('producto_id', $nIdprod);
                   })->get();

                   return $dato;
    }

    public function ListXProveedor(Request $request)
    {
    /*     $anio = date("Y");
       $factual = date("Y-m-d");
 */
//dd($request);

        if ($request->nidProveedor == null && $request->dFecha == null ) {
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->orderBy('Femision','desc')->get();
    /*         $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->whereBetween('Femision', [ $anio.'-'.'01-01', $factual])->get(); */
            return $dato;

        }
        elseif ($request->dFecha == null && $request->nIdtipoCompra == null) {
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->where('proveedor_id', $request->nidProveedor)->get();
            return $dato;
        }


        elseif($request->dFecha == null){
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->where('proveedor_id', $request->nidProveedor)
            ->where('tipo_ordencompra_id',$request->nIdtipoCompra)
            ->orderBy('Femision','desc')->get();
            return $dato;
        }

        elseif ($request->nidProveedor == null) {
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->where('tipo_ordencompra_id',$request->nIdtipoCompra)
            ->whereBetween('Femision', [$request->dFecha[0], $request->dFecha[1]])->get();
            return $dato;
        }

        elseif ($request->nidProveedor == null && $request->nIdtipoCompra == null) {
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->whereBetween('Femision', [$request->dFecha[0], $request->dFecha[1]])->get();
            return $dato;
        }



    }

    public function setGenerarOrderPedidoPdf(Request $request)
    {

        $valor = $request->get("params")['idOrderPedido'];
        $orderCompra = Ordencompra::with('proveedor',  'user', 'estadoordencompra', 'pago')->where('id', $valor)->first();
       // dd($orderCompra);
        $DetalleOrderCompra = Detalleordencompra::with('ordencompras', 'unidmedida', 'producto')->where('ordencompras_id', $valor)->get();
        $logo = asset('img/logo.gif');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.ordencomprapdf', [
            'logo' => $logo,
            'orderCompra' => $orderCompra,
            'DetalleOrderCompra' => $DetalleOrderCompra,
        ]);
        return $pdf->download('invoice.pdf');;
    }

    public function ListarDatosOrdenCompraXId(Request $request){

        $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')->where('id', $request->nIdOrdenCompra)->first();
     return $dato;

    }

    public function setDarBajaOrderCompra(Request $request){

     /*    $ordencompra = Ordencompra::where('codigo', $request->codigo)->first();

        $ordencompra->delete(); */

        Ordencompra::where('codigo', $request->codigo)->delete();
    }

    public function CargaDatosOrdenCompra(Request $request){

        $ordencompra = Ordencompra::where('codigo', $request->nidOrdenCompra)->first();
        $dato = Detalleordencompra::with('ordencompras', 'ordencompras.proveedor')->where('ordencompras_id', $ordencompra->id)->first();
        return $dato;

    }

    public function ListPrecioOrdCompra(Request $request){

        $nIdprod = $request->nIdprod;
        $dFechaByProduct = $request->dFechaByProduct;
        $fecha1= $request->fecha1;
        $fecha2= $request->fecha2;
        $estado = is_null($request->nIdprod) && empty($dFechaByProduct);


        if( $estado){
            $dato = Detalleordencompra::with('ordencompras', 'ordencompras.tipocambio', 'ordencompras.proveedor','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->get();
            return $dato;
        }else{

            if( $fecha1 == null &&  $fecha2 == null){
                $dato =  Detalleordencompra::with('ordencompras', 'ordencompras.tipocambio', 'ordencompras.proveedor','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
                    ->whereHas('ordencompras', function (Builder $query) use ($nIdprod) {$query->where('producto_id', $nIdprod);
                    })->get();

                    return $dato;
            }

            if($nIdprod === null){
                $dato =  Detalleordencompra::with('ordencompras', 'ordencompras.tipocambio', 'ordencompras.proveedor','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
                    ->whereHas('ordencompras', function (Builder $query) use ($fecha1,$fecha2){$query->whereBetween('Femision', [$fecha1, $fecha2]);
                })->get();


                return $dato;
            }
        }


  /*      $estado = is_null($request->nIdprod);


       if( $estado){
           $dato = Detalleordencompra::with('ordencompras', 'ordencompras.tipocambio', 'ordencompras.proveedor','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->get();
            return $dato;
        }else{
            $dato = Detalleordencompra::with('ordencompras', 'ordencompras.tipocambio', 'ordencompras.proveedor','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->where('producto_id', $request->nIdprod)->get();
        return $dato;
       } */

    }

    public function ListarPrecioxProveedorOC(Request $request){

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        $nidProveedor = $request->nidProveedor;

        if($nidProveedor){
            $dato = Ordencompra::with('proveedor','tipocambio','detalle','detalle.producto', 'detalle.producto.marca', 'detalle.producto.familia', 'detalle.producto.material', 'detalle.producto.modelotipo', 'detalle.producto.subfamilia', 'detalle.producto.homologacion')
            ->where('proveedor_id',$nidProveedor)->get();
            return $dato;

        }

        if($fecha1  && $fecha2 ){
            $dato = Ordencompra::with('proveedor','tipocambio','detalle','detalle.producto', 'detalle.producto.marca', 'detalle.producto.familia', 'detalle.producto.material', 'detalle.producto.modelotipo', 'detalle.producto.subfamilia', 'detalle.producto.homologacion')
            ->whereBetween('Femision',[$fecha1,$fecha2])->get();
            return $dato;
        }
    }

    public function exportPrecioOcExcelxProduct(Request $request){
        $listOrdenPedidoXProduct = json_decode($request->params['listOrdenPedidoXProduct']);

        return (new ListPrecprodExport)->setGenerarExcel($listOrdenPedidoXProduct)->download('invoices.xlsx');

    }

    public function exportPrecioOcExcelxProveedor(Request $request){
        $listOrdCompraxProveedor = json_decode($request->params['listOrdCompraxProveedor']);


        return (new ListPrecprovExport)->setGenerarExcel($listOrdCompraxProveedor)->download('invoices.xlsx');
    }

    public function setApruebaOrdenCompra(Request $request){
        Ordencompra::where('id', $request->id)->update(['estadoordencompra_id' => $request->valor]);

    }

    public function listTipoOrdenCompra(){
        $tipoOrdenCompra = TipOrdenCompra::all();
        return   $tipoOrdenCompra ;
    }

}
