<?php

namespace App\Http\Controllers\Administracion;

use App\Countable;
use App\Cliente;
use App\User;
use App\Almacen;
use App\DetalleKardex;
use App\DetalleMovimientoalmacen;
use App\DetalleParteIngSali;
use App\MovimientoAlmacen;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\UnidMedida;
use App\TipoTraslado;
use App\ModalidadTransporte;



use App\Http\Controllers\Controller;
use App\Kardex;
use App\ParteIngSali;
use App\TempMovAlmacen;
use Illuminate\Http\Request;

class MovimientoAlmacenController extends Controller
{
    public function create(Request $request)
    {

        $contador = Countable::all();
        $infoClient = Cliente::where('ruc', $request->nIdRuc)->first();
        $formatreq = date("Y-m-d");




        //Si es externo 
        if ($request->nIdTipoTraslado == 1) {
            $countGuia = $contador[0]->countAlmacenGuiaExterna;

            //$countAlmacenGuiaExterna = GuiaRemision::where('tipo_traslado_id', 1)->count();
            $infoUser = User::where('id', $request->nIdUser)->first();
            $infoAlmacen = Almacen::where('id', $infoUser->almacen_id)->first();

            if ($countGuia === 1) {
                $codigo = 'T001-0000001';
            } else {
                $codigo = 'T0' . $infoAlmacen->codigo . '-' . sprintf('%07d', $countGuia + 1);
            }


            if ($request->session()->has('products')) {
                $MovimientoAlmacen = new MovimientoAlmacen();
                $MovimientoAlmacen->codigo =  $codigo;
                $MovimientoAlmacen->fechaemision =  $formatreq;
                $MovimientoAlmacen->fechaenvio =  $request->cFechaTraslado;
                $MovimientoAlmacen->tipo_traslado_id =  $request->nIdTipoTraslado;
                $MovimientoAlmacen->comprobante =  mb_strtoupper($request->cComprobante);
                $MovimientoAlmacen->puntopartida_id =  $request->nIdPartida;
                $MovimientoAlmacen->puntollegada_id =  $request->nIdLlegada;
                $MovimientoAlmacen->cliente_id =  $infoClient->id;
                $MovimientoAlmacen->placaconductor =  $request->cPlacaVehiculo;
                $MovimientoAlmacen->motivotraslado_id =  $request->nIdMotivo;
                $MovimientoAlmacen->modalidadtransporte_id =  $request->nIdModTransporte;
                $MovimientoAlmacen->dniconductor =  $request->cDniConductor;
                $MovimientoAlmacen->pesototal =  $request->cPesoTotal;
                $MovimientoAlmacen->observaciones =  $request->cObservacion;
                $MovimientoAlmacen->estadopedido_id =  4;
                $MovimientoAlmacen->user_id =  $request->nIdUser;
                $MovimientoAlmacen->save();

                $detGuiaRemision = Session::get('products');
                $allProducts = $detGuiaRemision->map(function ($product) use ($MovimientoAlmacen) {

                    return [
                        'movimiento_almacen_id' => $MovimientoAlmacen->id,
                        'producto_id'      => $product->producto_id,
                        'cantidad' => $product->cantidad,
                        'peso'   => $product->peso,
                        'estadoprod_id'         => 1,
                        'unidmedida_id' => $product->unidmedida_id,


                    ];
                });
                DetalleMovimientoalmacen::insert($allProducts->toArray());
                DB::commit();
                Session::put('products', collect([]));
                Countable::where('id', 1)->update(['countAlmacenGuiaExterna' => $countGuia + 1]);
            }
        }

        //Si es interno 
        if ($request->nIdTipoTraslado == 2) {

            //$countGuiaInterno = GuiaRemision::where('tipo_traslado_id', 2)->count();
            $countGuia = $contador[0]->countAlmacenGuiaInterna;
            $infoUser = User::where('id', $request->nIdUser)->first();
            $infoAlmacen = Almacen::where('id', $infoUser->almacen_id)->first();
            if ($countGuia === 1) {
                $codigo = '001-0000001';
            } else {
                $codigo = '0' . $infoAlmacen->codigo . '-' . sprintf('%07d', $countGuia  + 1);
            }

            if ($request->session()->has('products')) {
                $MovimientoAlmacen = new MovimientoAlmacen();
                $MovimientoAlmacen->codigo =  $codigo;
                $MovimientoAlmacen->fechaemision =  $formatreq;
                $MovimientoAlmacen->fechaenvio =  $request->cFechaTraslado;
                $MovimientoAlmacen->tipo_traslado_id =  $request->nIdTipoTraslado;
                $MovimientoAlmacen->comprobante =  $request->cComprobante;
                $MovimientoAlmacen->puntopartida_id =  $request->nIdPartida;
                $MovimientoAlmacen->puntollegada_id =  $request->nIdLlegada;
                $MovimientoAlmacen->cliente_id =  $infoClient->id;
                $MovimientoAlmacen->placaconductor =  $request->cPlacaVehiculo;
                $MovimientoAlmacen->motivotraslado_id =  $request->nIdMotivo;
                $MovimientoAlmacen->modalidadtransporte_id =  $request->nIdModTransporte;
                $MovimientoAlmacen->dniconductor =  $request->cDniConductor;
                $MovimientoAlmacen->pesototal =  $request->cPesoTotal;
                $MovimientoAlmacen->observaciones =  $request->cObservacion;
                $MovimientoAlmacen->estadopedido_id =  4;
                $MovimientoAlmacen->user_id =  $request->nIdUser;
                $MovimientoAlmacen->save();

                $detGuiaRemision = Session::get('products');
                $allProducts = $detGuiaRemision->map(function ($product) use ($MovimientoAlmacen) {

                    return [
                        'movimiento_almacen_id' => $MovimientoAlmacen->id,
                        'producto_id'      => $product->producto_id,
                        'cantidad' => $product->cantidad,
                        'peso'   => $product->peso,
                        'estadoprod_id'         => 1,
                        'unidmedida_id' => $product->unidmedida_id,
                    ];
                });
                DetalleMovimientoalmacen::insert($allProducts->toArray());
                DB::commit();
                Session::put('products', collect([]));
                Countable::where('id', 1)->update(['countAlmacenGuiaInterna' => $countGuia + 1]);
            }
        }

        return response()->json(['message' => 'Guia de Remision pendiente agregada', 'icon' => 'success'], 200);
    }

    public function addProduct(Request $request)
    {
        $cantStock = Kardex::where('producto_id',$request->nIdprod)->first();
        

        if(!$cantStock  || $cantStock->stock <= 0){

            return response()->json([ 'message' => 'Stock vacio no permitido', 'icon' => 'error'], 200);
        }


        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);

        $exists = $products->firstWhere("producto_id", $product->id);

        if (!empty($exists)) {
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        } else {

            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();

            $TempGuiaRemision = new TempMovAlmacen();

            $TempGuiaRemision->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'unidmedNombre' => $unidmed->nombre, 'peso' => $request->cPeso, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($TempGuiaRemision);

            Session::put('products', $products);
        }
    }

    public  function ListtempGuiaRemision()
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

    public function tipotraslado()
    {
        $dato = TipoTraslado::all();
        return $dato;
    }

    public function ListModTransporte()
    {
        $dato = ModalidadTransporte::all();
        return $dato;
    }

    public function list(Request $request)
    {

        //dd($request);

        $datCliente = Cliente::where('ruc', $request->nIdRuc)->first();
        /*  Busqueda por Clientes */
        if ($request->dFecha === NULL && $request->nIdtEstadoCoti2 === NULL) {
            $dato = MovimientoAlmacen::with('tipo_traslado', 'puntopartida', 'puntollegada', 'cliente', 'motivotraslado', 'modalidadtransporte', 'estadopedido')->where('cliente_id', $datCliente->id)->get();
            return $dato;
        }

        /* Busqueda por fecha */
        if ($request->nIdCliente == NULL && $request->nIdtEstadoCoti2 == NULL) {
            $dato = MovimientoAlmacen::with('tipo_traslado', 'puntopartida', 'puntollegada', 'cliente', 'motivotraslado', 'modalidadtransporte', 'estadopedido')->whereBetween('fechaemision', [$request->dFechainicio, $request->dFechafin])->get();
            return $dato;
        }
    }

    public function getListDetMovAlmacen(Request $request)
    {
        $dato = DetalleMovimientoalmacen::with('producto', 'unidmedida', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->where('movimiento_almacen_id', $request->item)->get();
        return $dato;
    }

    public function procesar(Request $request)
    {

        $formatreq = date("Y-m-d");

        $movimiento_almacen = MovimientoAlmacen::where('id', $request->id)->first();
     

        $detalle_movimientoalmacen = DetalleMovimientoalmacen::with('producto', 'unidmedida', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->where('movimiento_almacen_id', $request->id)->get();
        $datCliente = Cliente::where('ruc', $request->nIdRuc)->first();


     
        // Ingresamos el kardex
        foreach ($detalle_movimientoalmacen as $dataDetMovimiento) {

            $kardexSearch = Kardex::where('producto_id', $dataDetMovimiento->producto_id)->get();

          foreach ($kardexSearch as $kardexSearchs) {

                $dataDetalleKardex = DetalleKardex::where('id', $kardexSearchs->id)->first();


                //Actualizamos el Stock del Kardex
                // Kardex::findOrFail($kardexSearchs->id)->update(['stock' => $dataDetMovimiento->cantidad + $kardexSearchs->stock]); 

                   $detalleKardex = new DetalleKardex();
                $detalleKardex->kardex_id =  $kardexSearchs->id;
                $detalleKardex->fecha =  $formatreq;
                $detalleKardex->FactNo =  '.';
                $detalleKardex->GuiaNo =  $movimiento_almacen->comprobante;
                $detalleKardex->proveedor_id =  19;
                $detalleKardex->motivo_id =  2;
                $detalleKardex->unidmedida_id =  $dataDetMovimiento->unidmedida_id;
                $detalleKardex->cantidad =  $dataDetMovimiento->cantidad;
                $detalleKardex->costunit =  $dataDetalleKardex->costunit;
                $detalleKardex->movimiento_id =  1;
                $detalleKardex->user_id =  $request->nIdUser;
                $detalleKardex->cliente_id =  $datCliente->id;
                $detalleKardex->save();
            } 

            $countParteIngSali = ParteIngSali::count();
            $formatYear = date("Y");
            //$date = Carbon::parse($request->cFecha)->format('Y-m-d');
            if ($countParteIngSali == 0) {
                $codPi = 'PI0001' . '-' . $formatYear;
            } else {
                $codPi = 'PI' . sprintf('%04d',  $countParteIngSali + 1) . '-' . $formatYear;
            }

            // Ingresamos parte de Ingreso
            $parteIngreso = new ParteIngSali();
            $parteIngreso->codigo = $codPi;
            $parteIngreso->Nrofactura =  '';
            $parteIngreso->Nroguia =  $movimiento_almacen->fechaenvio;
            $parteIngreso->Nroordencompras =  '';
            $parteIngreso->proveedor_id =  19;
            $parteIngreso->motivo_id =  2;
            $parteIngreso->Fecha =  $formatreq;
            $parteIngreso->observacion =  'MOVIMIENTO DE ALMACEN';
            $parteIngreso->user_id =  $request->nIdUser;
            $parteIngreso->almacen_id =   $movimiento_almacen->puntopartida_id;
            $parteIngreso->cliente_id =    $datCliente->id;
            $parteIngreso->movimiento_id =  2;
            $parteIngreso->estadopedido_id =  3;
            $parteIngreso->Nroordenservicio =  '';
            $parteIngreso->tipo_orden =  'N';
            $parteIngreso->save();

            $kardexSearch = Kardex::where('producto_id', $dataDetMovimiento->producto_id)->get();

            foreach ($kardexSearch as $kardexSearchs) {

                $dataDetalleKardex = DetalleKardex::where('id', $kardexSearchs->id)->first();
                
                            foreach ($detalle_movimientoalmacen as $dataDetMovimiento) {
                
                                $detalleParteIngreso = new DetalleParteIngSali();
                                $detalleParteIngreso->parte_ing_sali_id = $parteIngreso->id;
                                $detalleParteIngreso->producto_id = $dataDetMovimiento->producto_id;
                                $detalleParteIngreso->cantidad = $dataDetMovimiento->cantidad;
                                $detalleParteIngreso->unidmedida_id =  $dataDetMovimiento->unidmedida_id;
                                $detalleParteIngreso->punit = $dataDetalleKardex->costunit;
                                $detalleParteIngreso->estadopedido_id = 3;
                                $detalleParteIngreso->save();
                            }
            }

            // Ingresamos parte de Salida
            $parteSalida = new ParteIngSali();
            $parteSalida->codigo = $codPi;
            $parteSalida->Nrofactura =  '';
            $parteSalida->Nroguia =  $movimiento_almacen->fechaenvio;
            $parteSalida->Nroordencompras =  '';
            $parteSalida->proveedor_id =  19;
            $parteSalida->motivo_id =  2;
            $parteSalida->Fecha =  $formatreq;
            $parteSalida->observacion =  'MOVIMIENTO DE ALMACEN';
            $parteSalida->user_id =  $request->nIdUser;
            $parteSalida->almacen_id =   $movimiento_almacen->puntollegada_id;
            $parteSalida->cliente_id =    $datCliente->id;
            $parteSalida->movimiento_id =  1;
            $parteSalida->estadopedido_id =  3;
            $parteSalida->Nroordenservicio =  '';
            $parteSalida->tipo_orden =  'N';
            $parteSalida->save();


            foreach ($kardexSearch as $kardexSearchs) {

                $dataDetalleKardex = DetalleKardex::where('id', $kardexSearchs->id)->first();
            
                foreach ($detalle_movimientoalmacen as $dataDetMovimiento) {
    
                    $detalleParteIngreso = new DetalleParteIngSali();
                    $detalleParteIngreso->parte_ing_sali_id = $parteSalida->id;
                    $detalleParteIngreso->producto_id = $dataDetMovimiento->producto_id;
                    $detalleParteIngreso->cantidad = $dataDetMovimiento->cantidad;
                    $detalleParteIngreso->unidmedida_id =  $dataDetMovimiento->unidmedida_id;
                    $detalleParteIngreso->punit = $dataDetalleKardex->costunit;
                    $detalleParteIngreso->estadopedido_id = 3;
                    $detalleParteIngreso->save();
                }
            
            }

            //Actualizamos el estado del movimiento de almacen a Atendido
            MovimientoAlmacen::findOrFail($movimiento_almacen->id)->update(['estadopedido_id' => 3]);
        }
    }


}
