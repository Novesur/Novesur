<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Tipopago;
use App\UnidMedida;
use App\Cliente;
use App\TempCotizacion;
use App\Cotizacion;
use App\DetalleCotizacion;
use App\Countable;
use App\Exports\CotizacionFechaExport;
use App\Exports\CotizacionProductExport;
use App\Exports\CotizacionVendedorExport;
use App\Exports\ListDetCotiExport;
use App\Exports\ReporteVentasFechaEstadoExport;
use App\Exports\CotizacionAnalisisExport;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use Carbon\Carbon;



class CotizacionController extends Controller
{
    public function addTempCotizacion(Request $request)
    {


        $client = Cliente::find($request->nIdCliente);


        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);
        // $exists = $products->firstWhere("producto_id", $product->id);
        /*      if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);

        else : */

        if($client->tipoPrecio == "Lista")
        {
            if ($product->precioSugerido <= $request->cPUnit) {
                $articulo = $product;
                $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
                $tempcotizacion = new TempCotizacion;
                $tempcotizacion->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPUnit, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
                $products->push($tempcotizacion);
                Session::put('products', $products);
                return response()->json(['datos' => $products, 'message' => NULL]);
            } else {
                return response()->json(['datos' => $products, 'message' => 'El precio no puede ser menor que' . ' ' . $product->precioSugerido, 'icon' => 'error'], 200);
            }
        }

        if($client->tipoPrecio == "Distribuidor")
        {
            if ($product->precioDistribuidor <= $request->cPUnit) {
                $articulo = $product;
                $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
                $tempcotizacion = new TempCotizacion;
                $tempcotizacion->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPUnit, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
                $products->push($tempcotizacion);
                Session::put('products', $products);
                return response()->json(['datos' => $products, 'message' => NULL]);
            } else {
                return response()->json(['datos' => $products, 'message' => 'El precio no puede ser menor que' . ' ' . $product->precioDistribuidor, 'icon' => 'error'], 200);
            }
        }


    }

    public function addTempEditCotizacion(Request $request)
    {



        /*    $datos[] = array("cotizacion_id" => $request->item, "cantidad" => $request->cCantidad, "unidmedida_id" => $request->nIdUnidMed, "producto_id" => $request->nIdprod, "punit" => $request->cPUnit);
        $datos = json_encode($datos);
        var_dump($datos); */

        $Cotizacion = Cotizacion::where('codigo', $request->item)->first();

        /*    $searchProd = DetalleCotizacion::where('producto_id', $request->nIdprod)
            ->where('cotizacion_id', $Cotizacion->id)->exists();

        if ($searchProd != 1) { */
        $detcotizacion =  new DetalleCotizacion;
        $detcotizacion->cotizacion_id = $Cotizacion->id;
        $detcotizacion->cantidad = $request->cCantidad;
        $detcotizacion->unidmedida_id = $request->nIdUnidMed;
        $detcotizacion->producto_id = $request->nIdprod;
        $detcotizacion->punit = $request->cPUnit;
        $detcotizacion->save();
        //}
    }

    public function dellTempEditCotizacion(Request $request)
    {
        /*     $cant = DetalleCotizacion::where('id', $request->item)->get();
        $count = $cant->count();

        if ($count >= 2) {
            DetalleCotizacion::where('id', $request->item)->delete();
        } */

        DetalleCotizacion::where('id', $request->item)->delete();
    }

    public function create(Request $request)
    {

        $yearMaxID = date("Y");
       // $maxidCoti = Cotizacion::whereRaw('id = (select max(`id`) from cotizacion)')->first();
       $countable = Countable::all();

       $countCoti = $countable[0]->countcotizacion;




        if ($countCoti == 0) {

            $maxidCoti = '0001' . '-' . $yearMaxID;

        } else {

            $maxidCoti = sprintf('%04d', $countCoti + 1) . '-' . $yearMaxID;
        }

        DB::beginTransaction();
        try {

            if(empty($request->listarProductosPaginated)){
                return response()->json(['message' => 'Haga click en boton Agregar o campos de Producto vacios', 'icon' => 'warning'], 200);

            }else{
                if ($request->session()->has('products')) {
                    $formatreq = date("Y-m-d");
                    $cotizacion = new Cotizacion();
                    $cotizacion->fecha =  $formatreq;
                    $cotizacion->cliente_id =  $request->nIdCliente;
                    $cotizacion->user_id =  $request->nIdUsuario;
                    $cotizacion->estadopedido_id =  4;
                    $cotizacion->validezoferta =  $request->cValidez;
                    $cotizacion->Entrega =  mb_strtoupper($request->cEntrega);
                    $cotizacion->tipopago_id =  $request->nIdTipoPago;
                    $cotizacion->pago_id = $request->nIdDescripPago;
                    $cotizacion->flete =  $request->cFlete;
                    $cotizacion->documentacion =  $request->Docu;
                    $cotizacion->garantia_id =  $request->nIdGarantia;
                    $cotizacion->punto_llegada =  $request->cPuntoLlegada;
                    $cotizacion->transporte =  $request->cTransporte;
                    $cotizacion->consignado =  $request->Cconsignado;
                    $cotizacion->observacion = $request->cObservacion;
                    $cotizacion->codigo = $maxidCoti;
                    $cotizacion->fechacotiupdate =  $formatreq;
                    $cotizacion->save();



                    $detcotizacion = Session::get('products');
                    $allProducts = $detcotizacion->map(function ($product) use ($cotizacion) {
                        return [
                            'cotizacion_id' => $cotizacion->id,
                            'cantidad'      => $product->cantidad,
                            'unidmedida_id' => $product->unidmedida_id,
                            'producto_id'   => $product->producto_id,
                            'punit'         => $product->punit,
                            'EstadoNotPedido' => true
                        ];
                    });
                    DetalleCotizacion::insert($allProducts->toArray());
                    DB::commit();
                    Session::put('products', collect([]));
                    Countable::where('id', 1)->update(['countcotizacion' => $countCoti +1]);
                    return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
                }  else {
                    return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);

                }
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Verifique bien los valores ingresador por favor', 'icon' => 'warning'], 200);
        }
    }

    public function edit(Request $request)
    {

        $cotizacion = Cotizacion::where('codigo', $request->ncodCotizacion)->first();
        // $cotizacion->fecha = date("Y-m-d");
        $cotizacion->fecha = $cotizacion->fecha;
        $cotizacion->cliente_id =  $cotizacion->cliente_id;
        $cotizacion->user_id =  $cotizacion->user_id;
        $cotizacion->estadopedido_id =   $cotizacion->estadopedido_id;
        $cotizacion->validezoferta =  $request->cValidez;
        $cotizacion->Entrega =  mb_strtoupper($request->cEntrega);
        $cotizacion->tipopago_id =  $request->nIdTipoPago;
        $cotizacion->pago_id = $request->nIdDescripPago;
        $cotizacion->flete =  $request->cFlete;
        $cotizacion->documentacion =  $request->Docu;
        $cotizacion->garantia_id =  $request->nIdGarantia;
        $cotizacion->punto_llegada =  $request->cPuntoLlegada;
        $cotizacion->transporte =  $request->cTransporte;
        $cotizacion->consignado =  $request->Cconsignado;
        $cotizacion->observacion = $request->cObservacion;
        $cotizacion->fechacotiupdate =  date("Y-m-d");

        $cotizacion->save();
    }
    public  function ListtempCotizacion(Request $request)
    {
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function listTipoPago()
    {
        $dato = Tipopago::all();
        return $dato;
    }

    public function eliminarTempitemCoti()
    {
        Session::put('products', null);
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorder(Request $request)
    {

        $id = (int)trim($request->item);
        $items = session()->get('products') ?? collect([]);
        $exits = $items->firstWhere("producto_id", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto_id", [$id]);
            session()->put('products', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public function ListCotizacionesby(Request $request)
    {
        $nIdCliente   =    $request->nIdCliente;
        $nIdVendedor    =   $request->nIdVendedor;
        $nIdtEstadoCoti2 =   $request->nIdtEstadoCoti2;
        $dFechaInicio   =   $request->dFechainicio;
        $dFechaFin      =   $request->dFechafin;
        $anioactual = substr($dFechaInicio, 0, -6);

        $nIdCliente   =   ($nIdCliente   ==  NULL) ? ($nIdCliente   =   '') :   $nIdCliente;
        $nIdVendedor   =   ($nIdVendedor   ==  NULL) ? ($nIdVendedor   =   '') :   $nIdVendedor;
        $nIdtEstadoCoti2   =   ($nIdtEstadoCoti2   ==  NULL) ? ($nIdtEstadoCoti2   =   '') :   $nIdtEstadoCoti2;
        $dFechaInicio   =   ($dFechaInicio   ==  NULL) ? ($dFechaInicio   =   '') :   $dFechaInicio;
        $dFechaFin      =   ($dFechaFin   ==  NULL) ? ($dFechaFin   =   '') :   $dFechaFin;



        if ($anioactual >= '2022' or $anioactual == '') {

            $dato = DB::connection('mysql')->select('call sp_ReporteCotizacion (?,?,?,?,?)', [
                $nIdVendedor,
                $nIdCliente,
                $nIdtEstadoCoti2,
                $dFechaInicio,
                $dFechaFin
            ]);
            return $dato;
        }

        if ($anioactual == '2021') {

            $dato = DB::connection('mysql2')->select('call sp_ReporteCotizacion (?,?,?,?,?)', [
                $nIdVendedor,
                $nIdCliente,
                $nIdtEstadoCoti2,
                $dFechaInicio,
                $dFechaFin
            ]);
            return $dato;
        }
    }

    public function ReporteVentasFechaEstado(Request $request)
    {

        $nIdtEstadoCoti2 =   $request->nIdtEstadoCoti2;
        $dFechaInicio   =   $request->dFechainicio;
        $dFechaFin      =   $request->dFechafin;


        $nIdtEstadoCoti2   =   ($nIdtEstadoCoti2   ==  NULL) ? ($nIdtEstadoCoti2   =   '') :   $nIdtEstadoCoti2;
        $dFechaInicio   =   ($dFechaInicio   ==  NULL) ? ($dFechaInicio   =   '') :   $dFechaInicio;
        $dFechaFin      =   ($dFechaFin   ==  NULL) ? ($dFechaFin   =   '') :   $dFechaFin;


        $anioactual = substr($dFechaInicio, 0, -6);



        if ($anioactual >= '2022' or $anioactual == '') {
            $dato = DB::connection('mysql')->select('call sp_ReporteVentasFechaEstado (?,?,?)', [
                $nIdtEstadoCoti2,
                $dFechaInicio,
                $dFechaFin
            ]);
            return $dato;
        }

        if ($anioactual == '2021' or $anioactual == '') {
            $dato = DB::connection('mysql2')->select('call sp_ReporteVentasFechaEstado (?,?,?)', [
                $nIdtEstadoCoti2,
                $dFechaInicio,
                $dFechaFin
            ]);
            return $dato;
        }
    }

    public function ListCotizacionbyId(Request $request)
    {
        $dato = Cotizacion::where('codigo', $request->item)->first();
        return $dato;
    }

    public function editEstadoCotizacion(Request $request)
    {

        $cotizacion = Cotizacion::where('codigo', $request->itemid)->first();
        $cotizacion->fecha =  $cotizacion->fecha;
        $cotizacion->cliente_id =  $cotizacion->cliente_id;
        $cotizacion->user_id =  $cotizacion->user_id;
        $cotizacion->estadopedido_id =   $request->nIdtEstadoCoti;
        $cotizacion->validezoferta =   $cotizacion->validezoferta;
        $cotizacion->Entrega = $cotizacion->Entrega;
        $cotizacion->tipopago_id =  $cotizacion->tipopago_id;
        $cotizacion->pago_id = $cotizacion->pago_id;
        $cotizacion->flete =  $cotizacion->flete;
        $cotizacion->documentacion =  $cotizacion->documentacion;
        $cotizacion->garantia_id =   $cotizacion->garantia_id;
        $cotizacion->punto_llegada =   $cotizacion->punto_llegada;
        $cotizacion->transporte =  $cotizacion->transporte;
        $cotizacion->consignado =  $cotizacion->consignado;
        $cotizacion->observacion =  mb_strtoupper($request->cMotivoRechazo);
        $cotizacion->save();


        /* Cotizacion::findOrFail($request->itemid)->update(['estadopedido_id' => $request->nIdtEstadoCoti]); */
    }



    public function CotizacionCabecera(Request $request)
    {
        $dato = Cotizacion::with('cliente', 'user', 'tipopago', 'estadopedido', 'pago', 'garantia')->where('id', $request->nidCoti)->get();
        return $dato;
    }

    public function CotizacionPdf(Request $request)
    {

        //dd($request->get("params")['item']);
        $valor = $request->get("params")['item'];
        $fecha = $request->get("params")['fecha'];

        $anioactual = substr($fecha, 0, -6);

        if ($anioactual >= '2022' or $anioactual == '') {

            $coti = Cotizacion::on('mysql')->with('cliente', 'user', 'tipopago', 'estadopedido', 'pago', 'garantia')->where('codigo', $valor)->first();
            $detcoti = DetalleCotizacion::with('unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('cotizacion_id', $coti->id)->get();
            $logo = asset('img/logo.gif');
            $productos01 = asset('img/banner01.png');
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.reportepdf', [
                'logo' => $logo,
                'productos01' => $productos01,
                'coti' => $coti,
                'detcoti' => $detcoti,
            ]);
            return $pdf->download('invoice.pdf');
        }

        if ($anioactual == '2021' or $anioactual == '') {

            $coti = Cotizacion::on('mysql2')->with('cliente', 'user', 'tipopago', 'estadopedido', 'pago', 'garantia')->where('codigo', $valor)->first();
            $detcoti = DetalleCotizacion::with('unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('cotizacion_id', $coti->id)->get();
            $logo = asset('img/logo02.png');
            $productos01 = asset('img/banner01.png');
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.reportepdf', [
                'logo' => $logo,
                'productos01' => $productos01,
                'coti' => $coti,
                'detcoti' => $detcoti,
            ]);
            return $pdf->download('invoice.pdf');
        }
    }

    public function listCotizacionList(Request $request)
    {

        if ($request->cSelectAnios >= '2022') {
            $dato = DetalleCotizacion::on('mysql')->with('cotizacion', 'cotizacion.cliente', 'cotizacion.estadopedido', 'cotizacion.user')->where('producto_id', $request->nIdprod)->get();
            return $dato;
        }
        if ($request->cSelectAnios == '2021') {
            $dato = DetalleCotizacion::on('mysql2')->with('cotizacion', 'cotizacion.cliente', 'cotizacion.estadopedido', 'cotizacion.user')->where('producto_id', $request->nIdprod)->get();
            return $dato;
        }
    }

    public function listCotizacionListByDate(Request $request)

    {

        $anioSelect =  substr($request->fecha1, 0, -6);

        if ($anioSelect >= '2022') {

            $dato = Cotizacion::on('mysql')->with('cliente', 'estadopedido', 'user', 'detalle')
                ->whereBetween('fecha', [$request->fecha1, $request->fecha2])->orderBy('fecha', 'desc')->get();

            return collect($dato)->map(function ($item, $key) {


                if ($item->detalle) {
                    //$item['detalle_sum'] = collect($item->detalle)->sum('punit') ;  // Para sumar los campos

                    $item['detalle_sum'] = collect($item->detalle)->sum(function ($detalle) {
                        return floatval($detalle['punit']) * $detalle['cantidad'] * 1.18;   // Para calcular los campos
                    });
                } else {
                    $item['detalle_sum'] = 0;
                }

                return $item;
            })->all();
        }

        if ($anioSelect == '2021') {

            $dato = Cotizacion::on('mysql2')->with('cliente', 'estadopedido', 'user', 'detalle')
                ->whereBetween('fecha', [$request->fecha1, $request->fecha2])->get();

            return collect($dato)->map(function ($item, $key) {


                if ($item->detalle) {
                    //$item['detalle_sum'] = collect($item->detalle)->sum('punit') ;  // Para sumar los campos

                    $item['detalle_sum'] = collect($item->detalle)->sum(function ($detalle) {
                        return floatval($detalle['punit']) * $detalle['cantidad'] * 1.18;   // Para calcular los campos
                    });
                } else {
                    $item['detalle_sum'] = 0;
                }

                return $item;
            })->all();
        }
    }



    public function listCotizacionListByVendedor(Request $request)
    {

        $dato = Cotizacion::with('cliente', 'estadopedido', 'user', 'detalle')->where('user_id', $request->nIdVendedor)->get();


        return collect($dato)->map(function ($item, $key) {


            if ($item->detalle) {
                //$item['detalle_sum'] = collect($item->detalle)->sum('punit') ;  // Para sumar los campos

                $item['detalle_sum'] = collect($item->detalle)->sum(function ($detalle) {
                    return floatval($detalle['punit']) * $detalle['cantidad'] * 1.18;   // Para calcular los campos
                });
            } else {
                $item['detalle_sum'] = 0;
            }

            return $item;
        })->all();
    }


    public function listCotizacionListByClient(Request $request)
    {

        $dato = Cotizacion::with('cliente', 'estadopedido', 'user', 'detalle')->where('cliente_id', $request->nIdClient)->get();


        return collect($dato)->map(function ($item, $key) {


            if ($item->detalle) {
                //$item['detalle_sum'] = collect($item->detalle)->sum('punit') ;  // Para sumar los campos

                $item['detalle_sum'] = collect($item->detalle)->sum(function ($detalle) {
                    return floatval($detalle['punit']) * $detalle['cantidad'] * 1.18;   // Para calcular los campos
                });
            } else {
                $item['detalle_sum'] = 0;
            }

            return $item;
        })->all();
    }



    public function SumaTotalCotizacion(Request $request)
    {
        $dato = DetalleCotizacion::where('cotizacion_id', $request->id)->orderBy('id')->get();
        return $dato;
    }

    public function updateFechaCotizacion(Request $request)
    {
        $formatreq = date("Y-m-d");
        $cotizacion = Cotizacion::find($request->item);
        $cotizacion->fecha = $formatreq;
        $cotizacion->save();
    }

    public function exportProductCotizacion(Request $request)
    {

        // dd($request->params['listProductos']);
        $listCotizacion = json_decode($request->params['listCotizacion']);
        $codprod = $listCotizacion[0]->producto_id;

        $producto = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion', 'estado')->where('id', $codprod)->first();

        return (new CotizacionProductExport)->setGenerarExcel($listCotizacion, $producto)->download('invoices.xlsx');
    }


    public function exportReporteVentasFechaEstado(Request $request)
    {

        // dd($request->params['listProductos']);
        $listPaginacion = json_decode($request->params['listPaginacion']);
        /*  $codprod = $listCotizacion[0]->producto_id;

        $producto = Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion', 'estado')->where('id',$codprod)->first(); */

        return (new ReporteVentasFechaEstadoExport)->setGenerarExcel($listPaginacion)->download('invoices.xlsx');
    }




    public function exportFechaCotizacion(Request $request)
    {

        $listCotizacionByDate = json_decode($request->params['listCotizacionByDate']);

        return (new CotizacionFechaExport)->setGenerarExcel($listCotizacionByDate)->download('invoices.xlsx');
    }


    public function getExcelListProductFecha(Request $request)
    {

        $listDetProductByDate = json_decode($request->params['listDetProductByDate']);

        return (new ListDetCotiExport)->setGenerarExcel($listDetProductByDate)->download('invoices.xlsx');
    }




    public function exportVendedor(Request $request)
    {
        $listCotizacionByDate = json_decode($request->params['listCotizacionByDate']);
        return (new CotizacionVendedorExport)->setGenerarExcel($listCotizacionByDate)->download('invoices.xlsx');
    }

    public function buscaEstado(Request $request)
    {
        $dato = Cotizacion::with('estadopedido')->where('id', $request->item)->first();
        return $dato;
    }

    public function listDetalleProductosbyDate(Request $request){

  $nIdVendedor= $request->nIdVendedor;
  $fecha1 = $request->fecha1;
  $fecha2 = $request->fecha2;

  $nIdVendedor = ($nIdVendedor == NULL)? ($nIdVendedor = ''):$nIdVendedor;
  $fecha1 = ($fecha1 == NULL)? ($fecha1 = ''):$fecha1;
  $fecha2 = ($fecha2 == NULL)? ($fecha2 = ''):$fecha2;


  $rpta = DB::select('call sp_ConsultaListadoProducts (?, ?,?)',
  [
    $nIdVendedor,
    $fecha1 ,
    $fecha2
  ]);

  return $rpta;

       /*  $fecha1 = Carbon::parse($request->fecha1)->format('Y-m-d');
        $fecha2 = Carbon::parse($request->fecha2)->format('Y-m-d');
        $dato = Cotizacion::with('detalle','cliente','user','estadopedido','detalle.producto','detalle.producto.marca','detalle.producto.familia','detalle.producto.material','detalle.producto.modelotipo','detalle.producto.subfamilia','detalle.producto.homologacion')->whereBetween('fecha', [$fecha1,$fecha2])->get();
        return $dato; */

      }

      public function listDetalleProductosListByVendedor(Request $request){

        $dato = Cotizacion::with('detalle','cliente','user','estadopedido','detalle.producto','detalle.producto.marca','detalle.producto.familia','detalle.producto.material','detalle.producto.modelotipo','detalle.producto.subfamilia','detalle.producto.homologacion')->where('user_id', $request->nIdVendedor)->get();
        return $dato;

      }

      public function AnalisisCotizacionListByDate(Request $request){
        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        $dato =  DetalleCotizacion::with('cotizacion','cotizacion.user','producto','producto','producto.marca','producto.familia','producto.material','producto.modelotipo','producto.subfamilia','producto.homologacion')
            ->whereHas('cotizacion', function (Builder $query) use ($fecha1, $fecha2) {$query->whereBetween('fecha',[$fecha1, $fecha2]);
            })->get();
        return $dato;
      }

      public function ExcelAnalisisCotizacionFecha(Request $request){

        $listAnalisisDetProductByDate = json_decode($request->params['listAnalisisDetProductByDate']);
        return (new CotizacionAnalisisExport)->setGenerarExcel($listAnalisisDetProductByDate)->download('invoices.xlsx');

      }
}
