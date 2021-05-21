<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Tipopago;
use App\UnidMedida;
use App\TempCotizacion;
use App\Cotizacion;
use App\DetalleCotizacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;



class CotizacionController extends Controller
{
    public function addTempCotizacion(Request $request)
    {

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
            $tempcotizacion = new TempCotizacion;
            $tempcotizacion->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPUnit, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($tempcotizacion);
            Session::put('products', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);

        endif;
    }

    public function addTempEditCotizacion(Request $request)
    {



        $datos[] = array("cotizacion_id" => $request->item, "cantidad" => $request->cCantidad, "unidmedida_id" => $request->nIdUnidMed, "producto_id" => $request->nIdprod, "punit" => $request->cPUnit);
        $datos = json_encode($datos);
        var_dump($datos);
        /*
        $datcotizacion = Cotizacion::where('id',$request->item)->first();

        $searchProd = DetalleCotizacion::where('producto_id',$request->nIdprod)->first();
        if(!$searchProd){
            $cotizacion = new Cotizacion;
            $cotizacion->fecha =  $datcotizacion->fecha;
            $cotizacion->cliente_id = $datcotizacion->cliente_id;
            $cotizacion->user_id = $datcotizacion->user_id;
            $cotizacion->estadopedido_id = $datcotizacion->estadopedido_id;
            $cotizacion->validezoferta = $request->cValidez;
            $cotizacion->Entrega= $request->cEntrega;
            $cotizacion->tipopago_id = $request->nIdTipoPago;
            $cotizacion->pago_id = $request->nIdDescripPago;
            $cotizacion->flete = $request->cFlete;
            $cotizacion->documentacion = $request->Docu;
            $cotizacion->garantia_id = $request->nIdGarantia;
            $cotizacion->save();

            $detcotizacion =  new DetalleCotizacion;
            $detcotizacion->cotizacion_id = $request->item;
            $detcotizacion->cantidad = $request->cCantidad;
            $detcotizacion->unidmedida_id = $request->nIdUnidMed;
            $detcotizacion->producto_id = $request->nIdprod;
            $detcotizacion->punit = $request->cPUnit;
            $detcotizacion->save();
        }
 */
    }

    public function dellTempEditCotizacion(Request $request)
    {

        DetalleCotizacion::where('id', $request->item)->delete();
    }

    public function create(Request $request)
    {

        if ($request->session()->has('products')) {



            $formatreq = date("Y-m-d");
            $cotizacion = new Cotizacion();
            $cotizacion->fecha =  $formatreq;
            $cotizacion->cliente_id =  $request->nIdCliente;
            $cotizacion->user_id =  $request->nIdUsuario;
            $cotizacion->estadopedido_id =  $request->cEstado;
            $cotizacion->validezoferta =  $request->cValidez;
            $cotizacion->Entrega =  mb_strtoupper($request->cEntrega);
            $cotizacion->tipopago_id =  $request->nIdTipoPago;
            $cotizacion->pago_id = $request->nIdDescripPago;
            $cotizacion->flete =  $request->cFlete;
            $cotizacion->documentacion =  $request->Docu;
            $cotizacion->garantia_id =  $request->nIdGarantia;
            $cotizacion->punto_llegada =  $request->cPuntoLlegada;
            $cotizacion->transporte =  $request->cTransporte;
            $cotizacion->save();
            $detcotizacion = Session::get('products');

            $allProducts = $detcotizacion->map(function ($product) use ($cotizacion) {
                return [
                    'cotizacion_id' => $cotizacion->id,
                    'cantidad'      => $product->cantidad,
                    'unidmedida_id' => $product->unidmedida_id,
                    'producto_id'   => $product->producto_id,
                    'punit'         => $product->punit,
                ];
            });
            DetalleCotizacion::insert($allProducts->toArray());
            Session::put('products', collect([]));
            return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
        } else {
            return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
        }
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

        $nIdCliente   =   ($nIdCliente   ==  NULL) ? ($nIdCliente   =   '') :   $nIdCliente;
        $nIdVendedor   =   ($nIdVendedor   ==  NULL) ? ($nIdVendedor   =   '') :   $nIdVendedor;
        $nIdtEstadoCoti2   =   ($nIdtEstadoCoti2   ==  NULL) ? ($nIdtEstadoCoti2   =   '') :   $nIdtEstadoCoti2;
        $dFechaInicio   =   ($dFechaInicio   ==  NULL) ? ($dFechaInicio   =   '') :   $dFechaInicio;
        $dFechaFin      =   ($dFechaFin   ==  NULL) ? ($dFechaFin   =   '') :   $dFechaFin;

        $dato = DB::select('call sp_ReporteCotizacion (?,?,?,?,?)', [
            $nIdVendedor,
            $nIdCliente,
            $nIdtEstadoCoti2,
            $dFechaInicio,
            $dFechaFin
        ]);


        return $dato;
    }

    public function ListCotizacionbyId(Request $request)
    {
        $dato = Cotizacion::where('id', $request->item)->first();
        return $dato;
    }

    public function editEstadoCotizacion(Request $request)
    {
        Cotizacion::findOrFail($request->itemid)->update(['estadopedido_id' => $request->nIdtEstadoCoti]);
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
        $coti = Cotizacion::with('cliente', 'user', 'tipopago', 'estadopedido', 'pago', 'garantia')->where('id', $valor)->first();
        $detcoti = DetalleCotizacion::with('unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('cotizacion_id', $valor)->get();
        $logo = asset('img/logo02.png');
        $productos01 = asset('img/banner01.png');
        //dd($coti);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.reportepdf', [
            'logo' => $logo,
            'productos01' => $productos01,
            'coti' => $coti,
            'detcoti' => $detcoti,
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function listCotizacionList(Request $request)
    {
        $dato = DetalleCotizacion::with('cotizacion', 'cotizacion.cliente', 'cotizacion.estadopedido', 'cotizacion.user')->where('producto_id', $request->nIdprod)->get();
        return $dato;
    }

    public function listCotizacionListByDate(Request $request)

    {
        $dato = Cotizacion::with('cliente', 'estadopedido', 'user')->whereBetween('fecha', [$request->fecha1, $request->fecha2])->get();
        return $dato;
    }


    public function listCotizacionListByVendedor(Request $request)

    {
        $dato = Cotizacion::with('cliente', 'estadopedido', 'user')->where('user_id', $request->nIdVendedor)->get();
        return $dato;
    }
}
