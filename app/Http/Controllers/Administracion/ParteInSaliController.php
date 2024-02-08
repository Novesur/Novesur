<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleKardex;
use App\Detalleordencompra;
use App\Detalleordenservicio;
use App\DetalleParteIngSali;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\Ordencompra;
use App\Ordenservicio;
use App\ParteIngSali;
use App\Producto;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ParteInSaliController extends Controller
{
    public function create(Request $request)
    {

        $formatreq = date("Y-m-d");
        $formatYear = date("Y");
        $user = User::where('id', $request->nIdUser)->first();

        ///  Graba ingreso de mercaderias //////////////
        $parteIngSali = new ParteIngSali();
        // $date = Carbon::now();
        $countPIngreso = ParteIngSali::count();

        if ($countPIngreso == 0) {
            $codPi = 'PI0001' . '-' . $formatYear;
        } else {
            $codPi = 'PI' . sprintf('%04d',  $countPIngreso + 1) . '-' . $formatYear;
        }
        $parteIngSali->codigo =  $codPi;
        $parteIngSali->Nrofactura = '';
        $parteIngSali->Nroguia = '';
        $parteIngSali->Nroordencompras = '';
        $parteIngSali->proveedor_id = 19;
        $parteIngSali->motivo_id = 11;
        $parteIngSali->Fecha = $formatreq;
        $parteIngSali->observacion = 'INGRESO MERCADERIA';
        $parteIngSali->user_id = $request->nIdUser;
        $parteIngSali->almacen_id = $request->nIdAlmacen;
        $parteIngSali->cliente_id = 202;
        $parteIngSali->movimiento_id = 1;
        $parteIngSali->estadopedido_id = 2;
        $parteIngSali->save();

        $detalleParteIngSali = new DetalleParteIngSali();
        $detalleParteIngSali->parte_ing_sali_id = $parteIngSali->id;
        $detalleParteIngSali->producto_id = $request->nIdprod;
        $detalleParteIngSali->cantidad = $request->cCantidad;
        $detalleParteIngSali->unidmedida_id =  $request->nIdUnidMed;
        $detalleParteIngSali->punit = $request->punit;
        $detalleParteIngSali->estadopedido_id = 2;
        $detalleParteIngSali->save();

        $countKardex = Kardex::where('producto_id', $request->nIdprod)->count();
        if ($countKardex === 0) {
            $kardex = new Kardex;
            $kardex->producto_id = $request->nIdprod;
            $kardex->stock = $request->cCantidad;
            $kardex->costunit = $request->punit;
            $kardex->diferencia = 0;
            $kardex->save();
            Producto::where('id', $request->nIdprod)->update(['stock' => $request->cCantidad]);
        } else {
            $kardex = Kardex::where('producto_id', $request->nIdprod)->first();
            Kardex::where('producto_id', $request->nIdprod)->update(['stock' => $kardex->stock + $request->cCantidad]);
            Producto::where('id', $request->nIdprod)->update(['stock' => $kardex->stock + $request->cCantidad]);
        }

        $detalleKardex = new DetalleKardex();
        $detalleKardex->kardex_id = $kardex->id;
        $detalleKardex->fecha = $formatreq;
        $detalleKardex->FactNo = mb_strtoupper($codPi);
        $detalleKardex->GuiaNo = mb_strtoupper($codPi);
        $detalleKardex->proveedor_id = 19;
        $detalleKardex->motivo_id = 11;
        $detalleKardex->unidmedida_id = $request->nIdUnidMed;
        $detalleKardex->cantidad = $request->cCantidad;
        $detalleKardex->costunit = $request->punit;
        $detalleKardex->movimiento_id = 1;
        $detalleKardex->user_id = $request->nIdUser;
        $detalleKardex->cliente_id = 202;
        $detalleKardex->save();
    }

    public function saveParteIngresoOC(Request $request)
    {

        $formatreq = date("Y-m-d");

        $formatYear = date("Y");
        $user = User::where('id', $request->nIdUser)->first();

        ///  Graba Parte de Ingreso  //////////////
        $parteIngreso = new ParteIngSali();
        // $date = Carbon::now();
        $countParteIngSali = ParteIngSali::count();
        $Oc = Ordencompra::where('codigo', $request->cOrdenComPra)->first();
        //$date = Carbon::parse($request->cFecha)->format('Y-m-d');
        if ($countParteIngSali == 0) {
            $codPi = 'PI0001' . '-' . $formatYear;
        } else {
            $codPi = 'PI' . sprintf('%04d',  $countParteIngSali + 1) . '-' . $formatYear;
        }
        $parteIngreso->codigo =  $codPi;
        $parteIngreso->Nrofactura = mb_strtoupper($request->nroFactura);
        $parteIngreso->Nroguia = mb_strtoupper($request->nroguia);
        $parteIngreso->Nroordencompras = $request->cOrdenComPra;
        $parteIngreso->proveedor_id = $Oc->proveedor_id;
        $parteIngreso->motivo_id = $request->nIdMotivo;
        $parteIngreso->Fecha = $formatreq;
        $parteIngreso->observacion = mb_strtoupper($request->cobservacion);
        $parteIngreso->user_id = $request->nIdUser;
        $parteIngreso->almacen_id = $request->nIdAlmacen;
        $parteIngreso->cliente_id = 202;
        $parteIngreso->movimiento_id = 1;
        $parteIngreso->estadopedido_id = 2;
        $parteIngreso->Nroordenservicio = NULL;
        $parteIngreso->tipo_orden = 'C';
        

        $parteIngreso->save();

        /// Graba Parte de DetalleParteIngreso  //////////////
        $DOc = Detalleordencompra::where('ordencompras_id', $Oc->id)->where('canting', '>', 0)->get();
        //$DOc = Detalleordencompra::where('ordencompras_id', $Oc->id)->where('grabado', '1')->where('canting', '>', 0)->get();


        if ($DOc) {
            foreach ($DOc as  $datOc) {

                $resultado = intval($datOc->canting) >= 0;

                if ($resultado) {
                    $detalleParteIngreso = new DetalleParteIngSali;
                    $detalleParteIngreso->parte_ing_sali_id = $parteIngreso->id;
                    $detalleParteIngreso->producto_id = $datOc->producto_id;
                    $detalleParteIngreso->cantidad = $datOc->canting;
                    $detalleParteIngreso->unidmedida_id =  $datOc->unidmedida_id;
                    $detalleParteIngreso->punit = $datOc->punit;

                    //Si es completo

                    if ($datOc->cantidad == $datOc->canting) {
                        $detalleParteIngreso->estadopedido_id = 2;
                    } else {
                        $detalleParteIngreso->estadopedido_id = 4;
                    }
                    $detalleParteIngreso->save();
                }
                /// Grabamos Kardex  //////////////

                Detalleordencompra::where('id', $datOc->id)->update(['cantidadKardex' => intval($datOc->cantidadKardex) + intval($datOc->canting)]);

                if ($datOc->cantidad == ($datOc->cantidadKardex + $datOc->canting)) {
                    Detalleordencompra::where('producto_id', $datOc->producto_id)->update(['estado' => 1]);
                }


                $kardexCount = Kardex::where('producto_id', $datOc->producto_id)->count(); 

                if ($kardexCount === 0) {
                    $kardex = new Kardex;
                    $kardex->producto_id = $datOc->producto_id;
                    $kardex->stock = $datOc->cantidadKardex + intval($datOc->canting);
                    $kardex->costunit = $datOc->punit;
                    $kardex->diferencia = 0;
                    $kardex->save();


                    $detalleKardex = new DetalleKardex();
                    $detalleKardex->kardex_id = $kardex->id;
                    $detalleKardex->fecha = $formatreq;
                    $detalleKardex->FactNo = mb_strtoupper($request->nroFactura);
                    $detalleKardex->GuiaNo = mb_strtoupper($request->nroguia);
                    $detalleKardex->proveedor_id = $Oc->proveedor_id;
                    $detalleKardex->motivo_id = $request->nIdMotivo;
                    $detalleKardex->unidmedida_id = $datOc->unidmedida_id;
                    $detalleKardex->cantidad = $datOc->cantidadKardex + intval($datOc->canting);
                    $detalleKardex->costunit = $datOc->punit;
                    $detalleKardex->movimiento_id = 1;
                    $detalleKardex->user_id = $request->nIdUser;
                    $detalleKardex->cliente_id = 202;
                    $detalleKardex->save();
                    Detalleordencompra::where('id', $datOc->id)->update(['canting' => '0']);
                } else {

                    Kardex::where('producto_id', $datOc->producto_id)->update(['stock' => $datOc->cantidadKardex + intval($datOc->canting)]);



                    $kardex =  Kardex::where('producto_id', $datOc->producto_id)->first();
                    $detalleKardex = new DetalleKardex();
                    $detalleKardex->kardex_id = $kardex->id;
                    $detalleKardex->fecha = $formatreq;
                    $detalleKardex->FactNo = mb_strtoupper($request->nroFactura);
                    $detalleKardex->GuiaNo = mb_strtoupper($request->nroguia);
                    $detalleKardex->proveedor_id = $Oc->proveedor_id;
                    $detalleKardex->motivo_id = $request->nIdMotivo;
                    $detalleKardex->unidmedida_id = $datOc->unidmedida_id;
                    $detalleKardex->cantidad = $datOc->canting;
                    $detalleKardex->costunit = $datOc->punit;
                    $detalleKardex->movimiento_id = 1;
                    $detalleKardex->user_id = $request->nIdUser;
                    $detalleKardex->cliente_id = 202;
                    $detalleKardex->save();
                    Detalleordencompra::where('id', $datOc->id)->update(['canting' => '0']);
                }
                Producto::where('id', $datOc->producto_id)->update(['stock' => $datOc->cantidadKardex + intval($datOc->canting)]);
            }
            return response()->json(['message' => 'Grabado con exitos', 'icon' => 'success'], 200);
        }
    }

    public function saveParteIngresoOS(Request $request){

        $formatreq = date("Y-m-d");

        $formatYear = date("Y");
        $user = User::where('id', $request->nIdUser)->first();

        ///  Graba Parte de Ingreso  //////////////
        $parteIngreso = new ParteIngSali();
        // $date = Carbon::now();
        $countParteIngSali = ParteIngSali::count();
        $Oc = Ordenservicio::where('codigo', $request->cOrdenServicio)->first();
        //$date = Carbon::parse($request->cFecha)->format('Y-m-d');
        if ($countParteIngSali == 0) {
            $codPi = 'PI0001' . '-' . $formatYear;
        } else {
            $codPi = 'PI' . sprintf('%04d',  $countParteIngSali + 1) . '-' . $formatYear;
        }
        $parteIngreso->codigo =  $codPi;
        $parteIngreso->Nrofactura = mb_strtoupper($request->nroFactura);
        $parteIngreso->Nroguia = mb_strtoupper($request->nroguia);
        $parteIngreso->Nroordencompras = NULL;
        $parteIngreso->proveedor_id = $Oc->proveedor_id;
        $parteIngreso->motivo_id = $request->nIdMotivo;
        $parteIngreso->Fecha = $formatreq;
        $parteIngreso->observacion = mb_strtoupper($request->cobservacion);
        $parteIngreso->user_id = $request->nIdUser;
        $parteIngreso->almacen_id = $request->nIdAlmacen;
        $parteIngreso->cliente_id = 202;
        $parteIngreso->movimiento_id = 1;
        $parteIngreso->estadopedido_id = 2;
        $parteIngreso->Nroordenservicio = $request->cOrdenServicio;
        $parteIngreso->tipo_orden = 'S';
        

        $parteIngreso->save();

        /// Graba Parte de DetalleParteIngreso  //////////////
        $DOs = Detalleordenservicio::where('ordenservicio_id', $Oc->id)->where('canting', '>', 0)->get();
        //$DOc = Detalleordencompra::where('ordencompras_id', $Oc->id)->where('grabado', '1')->where('canting', '>', 0)->get();


        if ($DOs) {
            foreach ($DOs as  $datOc) {

                $resultado = intval($datOc->canting) >= 0;

                if ($resultado) {
                    $detalleParteIngreso = new DetalleParteIngSali;
                    $detalleParteIngreso->parte_ing_sali_id = $parteIngreso->id;
                    $detalleParteIngreso->producto_id = $datOc->producto_id;
                    $detalleParteIngreso->cantidad = $datOc->canting;
                    $detalleParteIngreso->unidmedida_id =  $datOc->unidmedida_id;
                    $detalleParteIngreso->punit = $datOc->punit;

                    //Si es completo

                    if ($datOc->cantidad == $datOc->canting) {
                        $detalleParteIngreso->estadopedido_id = 2;
                    } else {
                        $detalleParteIngreso->estadopedido_id = 4;
                    }
                    $detalleParteIngreso->save();
                }
                /// Grabamos Kardex  //////////////

                Detalleordenservicio::where('id', $datOc->id)->update(['cantidadKardex' => intval($datOc->cantidadKardex) + intval($datOc->canting)]);

                if ($datOc->cantidad == ($datOc->cantidadKardex + $datOc->canting)) {
                    Detalleordenservicio::where('producto_id', $datOc->producto_id)->update(['estado' => 1]);
                }


                $kardexCount = Kardex::where('producto_id', $datOc->producto_id)->count(); 

                if ($kardexCount === 0) {
                    $kardex = new Kardex;
                    $kardex->producto_id = $datOc->producto_id;
                    $kardex->stock = $datOc->cantidadKardex + intval($datOc->canting);
                    $kardex->costunit = $datOc->punit;
                    $kardex->diferencia = 0;
                    $kardex->save();


                    $detalleKardex = new DetalleKardex();
                    $detalleKardex->kardex_id = $kardex->id;
                    $detalleKardex->fecha = $formatreq;
                    $detalleKardex->FactNo = mb_strtoupper($request->nroFactura);
                    $detalleKardex->GuiaNo = mb_strtoupper($request->nroguia);
                    $detalleKardex->proveedor_id = $Oc->proveedor_id;
                    $detalleKardex->motivo_id = $request->nIdMotivo;
                    $detalleKardex->unidmedida_id = $datOc->unidmedida_id;
                    $detalleKardex->cantidad = $datOc->cantidadKardex + intval($datOc->canting);
                    $detalleKardex->costunit = $datOc->punit;
                    $detalleKardex->movimiento_id = 1;
                    $detalleKardex->user_id = $request->nIdUser;
                    $detalleKardex->cliente_id = 202;
                    $detalleKardex->save();
                    Detalleordenservicio::where('id', $datOc->id)->update(['canting' => '0']);
                } else {

                    Kardex::where('producto_id', $datOc->producto_id)->update(['stock' => $datOc->cantidadKardex + intval($datOc->canting)]);



                    $kardex =  Kardex::where('producto_id', $datOc->producto_id)->first();
                    $detalleKardex = new DetalleKardex();
                    $detalleKardex->kardex_id = $kardex->id;
                    $detalleKardex->fecha = $formatreq;
                    $detalleKardex->FactNo = mb_strtoupper($request->nroFactura);
                    $detalleKardex->GuiaNo = mb_strtoupper($request->nroguia);
                    $detalleKardex->proveedor_id = $Oc->proveedor_id;
                    $detalleKardex->motivo_id = $request->nIdMotivo;
                    $detalleKardex->unidmedida_id = $datOc->unidmedida_id;
                    $detalleKardex->cantidad = $datOc->canting;
                    $detalleKardex->costunit = $datOc->punit;
                    $detalleKardex->movimiento_id = 1;
                    $detalleKardex->user_id = $request->nIdUser;
                    $detalleKardex->cliente_id = 202;
                    $detalleKardex->save();
                    Detalleordenservicio::where('id', $datOc->id)->update(['canting' => '0']);
                }
                Producto::where('id', $datOc->producto_id)->update(['stock' => $datOc->cantidadKardex + intval($datOc->canting)]);
            }
            return response()->json(['message' => 'Grabado con exitos', 'icon' => 'success'], 200);
        }

    }


    public function saveParteSalida(Request $request)
    {

        $date = Carbon::now();
        $date = Carbon::parse($request->cFecha)->format('Y-m-d');


        $countPSalida = ParteIngSali::where('movimiento_id', 2)->count();

        $estado = 1;
        if ($countPSalida == 0) {
            $codPs = 'PS0001' . '-' . Carbon::parse($request->cFecha)->format('Y');
        } else {
            $codPs = 'PS' . sprintf('%04d', intval($countPSalida) + 1) . '-' . Carbon::parse($request->cFecha)->format('Y');
        };

        $pSalida = new ParteIngSali();
        $pSalida->codigo =  $codPs;
        $pSalida->Nrofactura = mb_strtoupper($request->nroFactura);
        $pSalida->Nroguia = mb_strtoupper($request->nroguia);
        $pSalida->Nroordencompras = $request->cOrdenComPra;
        $pSalida->proveedor_id = 19;
        $pSalida->motivo_id = $request->nIdMotivo;
        $pSalida->Fecha = $date;
        $pSalida->observacion = mb_strtoupper($request->cobservacion);
        $pSalida->user_id = $request->nIdUser;
        $pSalida->almacen_id = $request->nIdAlmacen;
        $pSalida->cliente_id = 202;
        $pSalida->movimiento_id = 2;
        $pSalida->estadopedido_id = 1;
        $pSalida->save();

        $detpsalida = Session::get('psalida');

        $allpsalida = $detpsalida->map(function ($product) use ($pSalida) {
            return [
                'parte_ing_sali_id' => $pSalida->id,
                'producto_id'   => $product->producto_id,
                'cantidad'      => $product->cantidad,
                'unidmedida_id' => $product->unidmedida_id,
                'punit' => 0,
                'estadopedido_id' => 1,
            ];
        });
        $allpsalida = $allpsalida->toArray();
        DetalleParteIngSali::insert($allpsalida);
        foreach ($allpsalida as $item) {
            $temp = (object)$item;

            $kardex = Kardex::where('producto_id', $temp->producto_id)->first();
            $kardex->producto_id = $temp->producto_id;
            $kardex->stock = $kardex->stock - $temp->cantidad;
            $kardex->costunit =  $kardex->costunit;
            $kardex->diferencia =  NULL;
            $kardex->save();

            $DetalleKardex = new DetalleKardex();
            $DetalleKardex->kardex_id = $kardex->id;
            $DetalleKardex->fecha = $date;
            $DetalleKardex->FactNo = $request->nroFactura;
            $DetalleKardex->GuiaNo = $request->nroguia;
            $DetalleKardex->proveedor_id = '19';
            $DetalleKardex->motivo_id = $request->nIdMotivo;
            $DetalleKardex->unidmedida_id = $temp->unidmedida_id;
            $DetalleKardex->cantidad = $temp->cantidad;
            $DetalleKardex->costunit =  $kardex->costunit;
            $DetalleKardex->movimiento_id =  '2';
            $DetalleKardex->user_id =  $request->nIdUser;
            $DetalleKardex->cliente_id =  $request->nIdCliente;
            $DetalleKardex->save();
        }
        Kardex::where('producto_id', $temp->producto_id)->update(['stock' => $kardex->stock]);

        Producto::where('id', $temp->producto_id)->update(['stock' => $kardex->stock]);

        Session::put('psalida', collect([]));
        return response()->json(['message' => 'Grabado con exitos', 'icon' => 'success'], 200);
    }

    public function listStockByproduct(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdprod = $request->nIdprod;

        $nIdprod = ($nIdprod == NULL) ? ($nIdprod = 0) : $nIdprod;
        $rpta = DB::select('call sp_stockProductos (?)', [
            $nIdprod
        ]);
        return $rpta;
    }

    public function StockProductByAlmacen(Request $request){ 

     
       if (!$request->ajax()) return redirect('/');
        $nIdprod = $request->nIdprod;
        $nIdAlmacen = $request->nIdAlmacen;

        $nIdprod = ($nIdprod == NULL) ? ($nIdprod = 0) : $nIdprod;
        $nIdAlmacen = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $rpta = DB::select('call sp_StockByProd_Almacen (?,?)', [
            $nIdprod,
            $nIdAlmacen 
        ]);
        return $rpta;  
    }
    public function ListarDatosOrdenCompra(Request $request)
    {

        $cOrdenComPra = $request->cOrdenComPra;

        $dato = Detalleordencompra::with('ordencompras', 'unidmedida', 'producto', 'producto.familia', 'producto.subfamilia', 'producto.modelotipo', 'producto.marca', 'producto.material', 'producto.homologacion', 'ordencompras.proveedor', 'ordencompras.estadoordencompra')
            /* ->where('estado', 2) */
            ->whereHas('ordencompras', function (Builder $query) use ($cOrdenComPra) {
                $query->where('codigo', $cOrdenComPra);
            })->get();
        return $dato;
    }

    public function ListarDatosOrdenServicio(Request $request)
    {

        $cOrdenServicio = $request->cOrdenServicio;
        $dato = Detalleordenservicio::with('ordenservicio', 'unidmedida', 'producto', 'producto.familia', 'producto.subfamilia', 'producto.modelotipo', 'producto.marca', 'producto.material', 'producto.homologacion', 'ordenservicio.proveedor', 'ordenservicio.estadoordencompra')
            ->whereHas('ordenservicio', function (Builder $query) use ($cOrdenServicio) {
                $query->where('codigo', $cOrdenServicio);
            })->get();
        return $dato;
    }

    

    public function eliminarTemporder()
    {
        Session::put('products', null);
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }


    
    
}
