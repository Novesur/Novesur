<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Tipopago;
use App\UnidMedida;
use App\Cliente;
use App\TempCotizacionLibre;
use App\CotizacionLibre;
use App\CotizacionLibreDetalle;
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

class CotizacionLibreController extends Controller
{
    public function addTempCotizacionLibre(Request $request)


    {
       $products = Session::get('productsLibre');
        $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
        $tempcotizacionLibre = new TempCotizacionLibre;
        $tempcotizacionLibre->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed,'producto'=> $request->nIdprod,'punit' => $request->cPUnit, 'total' => $request->cTotal,'unidmedNombre' => $unidmed->nombre]);
        Session::put('productsLibre',collect($products)->push($tempcotizacionLibre) );
       // $products->push($tempcotizacionLibre);

        return response()->json(['datos' => $tempcotizacionLibre, 'message' => NULL]);
    }


    public function addTempEditCotizacion(Request $request)
    {
        /*    $datos[] = array("cotizacion_id" => $request->item, "cantidad" => $request->cCantidad, "unidmedida_id" => $request->nIdUnidMed, "producto_id" => $request->nIdprod, "punit" => $request->cPUnit);
        $datos = json_encode($datos);
        var_dump($datos); */

        $cotizacionLibre = CotizacionLibre::where('codigo', $request->item)->first();

        /*    $searchProd = CotizacionLibreDetalle::where('producto_id', $request->nIdprod)
            ->where('cotizacion_id', $cotizacionLibre->id)->exists();

        if ($searchProd != 1) { */
        $detcotizacionLibre =  new CotizacionLibreDetalle;
        $detcotizacionLibre->cotizacionlibre_id = $cotizacionLibre->id;
        $detcotizacionLibre->cantidad = $request->cCantidad;
        $detcotizacionLibre->unidmedida_id = $request->nIdUnidMed;
        $detcotizacionLibre->producto = $request->nIdprod;
        $detcotizacionLibre->punit = $request->cPUnit;
        $detcotizacionLibre->save();
        //}
    }

    public function dellTempEditCotizacion(Request $request)
    {

        CotizacionLibreDetalle::where('id', $request->item)->delete();
    }

    public function create(Request $request)
    {
//dd($request);

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
                if ($request->session()->has('productsLibre')) {
                    $formatreq = date("Y-m-d");
                    $cotizacionLibre = new CotizacionLibre();
                    $cotizacionLibre->fecha =  $formatreq;
                    $cotizacionLibre->cliente_id =  $request->nIdCliente;
                    $cotizacionLibre->user_id =  $request->nIdUsuario;
                    $cotizacionLibre->estadopedido_id =  4;
                    $cotizacionLibre->validezoferta =  $request->cValidez;
                    $cotizacionLibre->Entrega =  mb_strtoupper($request->cEntrega);
                    $cotizacionLibre->tipopago_id =  $request->nIdTipoPago ;
                    $cotizacionLibre->pago_id = $request->cFPago;
                    $cotizacionLibre->flete =  $request->cFlete;
                    $cotizacionLibre->documentacion =  $request->Docu;
                    $cotizacionLibre->garantia_id =  $request->nIdGarantia;
                    $cotizacionLibre->punto_llegada =  $request->cPuntoLlegada;
                    $cotizacionLibre->transporte =  $request->cTransporte;
                    $cotizacionLibre->consignado =  $request->Cconsignado;
                    $cotizacionLibre->observacion = $request->cObservacion;
                    $cotizacionLibre->codigo = $maxidCoti;
                    $cotizacionLibre->fechacotiupdate =  $formatreq;
                    $cotizacionLibre->save();



                    $detcotizacionLibre = Session::get('productsLibre');

                    $allProducts = $detcotizacionLibre->map(function ($product) use ($cotizacionLibre) {
                        return [
                            'cotizacionlibre_id' => $cotizacionLibre->id,
                            'cantidad'      => $product->cantidad,
                            'unidmedida_id' => $product->unidmedida_id,
                            'producto'   => $product->producto,
                            'punit'         => $product->punit,
                            'EstadoNotPedido' => true
                        ];
                    });
                    CotizacionLibreDetalle::insert($allProducts->toArray());
                    DB::commit();
                    Session::put('productsLibre', collect([]));
                    Countable::where('id', 1)->update(['countcotizacion' => $countCoti +1]);
                    return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
                }   else {
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

        $cotizacionLibre = CotizacionLibre::where('codigo', $request->ncodCotizacion)->first();
        // $cotizacionLibre->fecha = date("Y-m-d");
        $cotizacionLibre->fecha = $cotizacionLibre->fecha;
        $cotizacionLibre->cliente_id =  $cotizacionLibre->cliente_id;
        $cotizacionLibre->user_id =  $cotizacionLibre->user_id;
        $cotizacionLibre->estadopedido_id =   $cotizacionLibre->estadopedido_id;
        $cotizacionLibre->validezoferta =  $request->cValidez;
        $cotizacionLibre->Entrega =  mb_strtoupper($request->cEntrega);
        $cotizacionLibre->tipopago_id =  $request->nIdTipoPago;
        $cotizacionLibre->pago_id = $request->nIdDescripPago;
        $cotizacionLibre->flete =  $request->cFlete;
        $cotizacionLibre->documentacion =  $request->Docu;
        $cotizacionLibre->garantia_id =  $request->nIdGarantia;
        $cotizacionLibre->punto_llegada =  $request->cPuntoLlegada;
        $cotizacionLibre->transporte =  $request->cTransporte;
        $cotizacionLibre->consignado =  $request->Cconsignado;
        $cotizacionLibre->observacion = $request->cObservacion;
        $cotizacionLibre->fechacotiupdate =  date("Y-m-d");

        $cotizacionLibre->save();
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
        Session::put('productsLibre', null);
        $dato = session()->get('productsLibre') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorder(Request $request)
    {
        $id = strval(trim($request->item));
        $items = session()->get('productsLibre') ?? collect([]);
       // dd($items);
        $exits = $items->firstWhere("producto", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto", [$id]);
            session()->put('productsLibre', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public function ListCotizacionesby(Request $request)
    {
       // dd($request);

        $nIdCliente   =    $request->nIdCliente;
        $nIdVendedor    =   $request->nIdVendedor;
        $dFechaInicio   =   $request->dFechainicio;
        $dFechaFin      =   $request->dFechafin;
        $anioactual = substr($dFechaInicio, 0, -6);

        $nIdCliente   =   ($nIdCliente   ==  NULL) ? ($nIdCliente   =   '') :   $nIdCliente;
        $nIdVendedor   =   ($nIdVendedor   ==  NULL) ? ($nIdVendedor   =   '') :   $nIdVendedor;
        $dFechaInicio   =   ($dFechaInicio   ==  NULL) ? ($dFechaInicio   =   '') :   $dFechaInicio;
        $dFechaFin      =   ($dFechaFin   ==  NULL) ? ($dFechaFin   =   '') :   $dFechaFin;



        if ($anioactual >= '2022' or $anioactual == '') {

            $dato = DB::connection('mysql')->select('call sp_ReporteCotizacionlibre (?,?,?,?)', [
                $nIdVendedor,
                $nIdCliente,
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

        $cotizacionLibre = CotizacionLibre::where('codigo', $request->itemid)->first();
        $cotizacionLibre->fecha =  $cotizacionLibre->fecha;
        $cotizacionLibre->cliente_id =  $cotizacionLibre->cliente_id;
        $cotizacionLibre->user_id =  $cotizacionLibre->user_id;
        $cotizacionLibre->validezoferta =   $cotizacionLibre->validezoferta;
        $cotizacionLibre->Entrega = $cotizacionLibre->Entrega;
        $cotizacionLibre->tipopago_id =  $cotizacionLibre->tipopago_id;
        $cotizacionLibre->pago_id = $cotizacionLibre->pago_id;
        $cotizacionLibre->flete =  $cotizacionLibre->flete;
        $cotizacionLibre->documentacion =  $cotizacionLibre->documentacion;
        $cotizacionLibre->garantia_id =   $cotizacionLibre->garantia_id;
        $cotizacionLibre->punto_llegada =   $cotizacionLibre->punto_llegada;
        $cotizacionLibre->transporte =  $cotizacionLibre->transporte;
        $cotizacionLibre->consignado =  $cotizacionLibre->consignado;
        $cotizacionLibre->observacion =  mb_strtoupper($request->cMotivoRechazo);
        $cotizacionLibre->save();


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

            $coti = CotizacionLibre::on('mysql')->with('cliente', 'user', 'tipopago', 'estadopedido', 'pago', 'garantia')->where('codigo', $valor)->first();
            $detcoti = CotizacionLibreDetalle::with('unidmedida')->where('cotizacionlibre_id', $coti->id)->get();
            $logo = asset('img/logo.gif');
            $qr= asset('img/QR.jpeg');
            $productos01 = asset('img/banner01.png');
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.cotizacion_librepdf', [
                'logo' => $logo,
                'productos01' => $productos01,
                'coti' => $coti,
                'detcoti' => $detcoti,
                'qr'=>$qr,
            ]);
            return $pdf->download('invoice.pdf');
        }

    }

    public function listCotizacionList(Request $request)
    {

        if ($request->cSelectAnios >= '2022') {
            $dato = CotizacionLibreDetalle::on('mysql')->with('cotizacion_libre', 'cotizacion_libre.cliente', 'cotizacion_libre.estadopedido', 'cotizacion_libre.user')->where('producto','like','%'. $request->cNomProduct .'%')->get();

            return $dato;
        }
        if ($request->cSelectAnios == '2021') {
            $dato = CotizacionLibreDetalle::on('mysql2')->with('cotizacion_libre', 'cotizacion_libre.cliente', 'cotizacion_libre.estadopedido', 'cotizacion_libre.user')->where('producto','like','%'. $request->cNomProduct .'%')->get();
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

        $dato = Cotizacion::with('cliente', 'estadopedido', 'user', 'detalle')->where('user_id', $request->nIdVendedor)->orderBy('fecha', 'desc')->get();


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


        $dato = Cotizacion::with('cliente', 'estadopedido', 'user', 'detalle')->where('cliente_id', $request->nIdClient)->orderBy('fecha', 'desc')->get();



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
        $dato = CotizacionLibreDetalle::where('cotizacion_id', $request->id)->orderBy('id')->get();
        return $dato;
    }

    public function updateFechaCotizacion(Request $request)
    {
        $formatreq = date("Y-m-d");
        $cotizacionLibre = Cotizacion::find($request->item);
        $cotizacionLibre->fecha = $formatreq;
        $cotizacionLibre->save();
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


  $rpta = DB::select('call sp_ConsultaCotiLibreByProducts (?, ?,?)',
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
        $dato =  CotizacionLibreDetalle::with('cotizacion','cotizacion.user','cotizacion.cliente','producto','producto','producto.marca','producto.familia','producto.material','producto.modelotipo','producto.subfamilia','producto.homologacion')
            ->whereHas('cotizacion', function (Builder $query) use ($fecha1, $fecha2) {$query->whereBetween('fecha',[$fecha1, $fecha2]);
            })->get();
        return $dato;
      }

      public function ExcelAnalisisCotizacionFecha(Request $request){

        $listAnalisisDetProductByDate = json_decode($request->params['listAnalisisDetProductByDate']);
        return (new CotizacionAnalisisExport)->setGenerarExcel($listAnalisisDetProductByDate)->download('invoices.xlsx');

      }
    }
