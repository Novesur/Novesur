<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleKardex;
use App\Detalleordencompra;
use App\Detalleparteingreso;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\Ordencompra;
use App\Parteingreso;
use App\Partesalida;
use Illuminate\Http\Request;
use App\Producto;
use App\UnidMedida;
use App\User;
use App\ReporteParteIngreso;
use Illuminate\Support\Facades\Session;
use App\TempPIngreso;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class ParteIngresoController extends Controller
{


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

    public function CambiarEstadoDetalleOC(Request $request)
    {

        //dd($request);
        //$Oc= Ordencompra::where('id', $request->nIdOC)->first();
        dd($request->cEstado);

        if ($request->cEstado == 1) {
            //Ordencompra::where('id', $request->nIdOC)->update(array('estadoordencompra_id' => 2));
            Detalleordencompra::where('id', $request->nIdOC)->update(array('estado' => 2));
        }


        if ($request->cEstado == 2) {
            //Ordencompra::where('id', $request->nIdOC)->update(array('estadoordencompra_id' => 1));

            Detalleordencompra::where('id', $request->nIdOC)->update(array('estado' => 1));
        }
    }




    public function addPIngreso(Request $request)
    {

        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $pingreso = Session::get('pingreso');
        $pingreso = ($pingreso != null) ? collect($pingreso) : collect([]);
        $exists = $pingreso->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $pingreso, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $tempPIngreso = new TempPIngreso;
            $tempPIngreso->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPrecio,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre, 'cantidad' => $request->cCantidad]);
            $pingreso->push($tempPIngreso);
            Session::put('pingreso', $pingreso);
            return response()->json(['icon' => 'success'], 200);


        endif;
    }

    public  function ListtempParteIngreso()
    {
        $dato = session()->get('pingreso') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function eliminarTempitemPIngreso()
    {
        Session::put('pingreso', null);
        $dato = session()->get('pingreso') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function setGrabaPIngreso(Request $request)
    {


        $formatreq = date("Y-m-d");

        $formatYear = date("Y");
        $user = User::where('id', $request->nIdUser)->first();

        ///  Graba Parte de Ingreso  //////////////
        $parteIngreso = new Parteingreso();
        // $date = Carbon::now();
        $countPIngreso = Parteingreso::count();
        $Oc = Ordencompra::where('codigo', $request->cOrdenComPra)->first();
        //$date = Carbon::parse($request->cFecha)->format('Y-m-d');
        if ($countPIngreso == 0) {
            $codPi = 'PI0001' . '-' . $formatYear;
        } else {
            $codPi = 'PI' . sprintf('%04d',  $countPIngreso + 1) . '-' . $formatYear;
        }
        $parteIngreso->codigo =  $codPi;
        $parteIngreso->Nrofactura = mb_strtoupper($request->nroFactura);
        $parteIngreso->Nroguia = mb_strtoupper($request->nroguia);
        $parteIngreso->ordencompras_id = $Oc->id;
        $parteIngreso->proveedor_id = $Oc->proveedor_id;
        $parteIngreso->motivo_id = $request->nIdMotivo;
        $parteIngreso->Fecha = $formatreq;
        $parteIngreso->observacion = mb_strtoupper($request->cobservacion);
        $parteIngreso->user_id = $request->nIdUser;
        $parteIngreso->almacen_id = $user->almacen_id;
        $parteIngreso->save();

        /// Graba Parte de DetalleParteIngreso  //////////////


        $DOc = Detalleordencompra::where('ordencompras_id', $Oc->id)->where('canting', '>', 0)->get();
        //$DOc = Detalleordencompra::where('ordencompras_id', $Oc->id)->where('grabado', '1')->where('canting', '>', 0)->get();

        if ($DOc) {
            foreach ($DOc as  $datOc) {

                $resultado = intval($datOc->canting) >= 0;

                if ($resultado) {
                    $detalleParteIngreso = new detalleParteIngreso;
                    $detalleParteIngreso->parteingreso_id = $parteIngreso->id;
                    $detalleParteIngreso->producto_id = $datOc->producto_id;
                    $detalleParteIngreso->cantidad = $datOc->canting;
                    $detalleParteIngreso->unidmedida_id =  $datOc->unidmedida_id;
                    $detalleParteIngreso->punit = $datOc->punit;
                    //Si es completo

                    if ($datOc->cantidad == $datOc->canting) {
                        $detalleParteIngreso->estado = '1';
                    } else {
                        $detalleParteIngreso->estado = '2';
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



    public function ListParteIngreso(Request $request)
    {


        $nIdProveedor = $request->nIdProveedor;
        $fecha1 = Carbon::parse($request->fecha1)->format('Y-m-d');
        $fecha2 = Carbon::parse($request->fecha2)->format('Y-m-d');
        $dFecha = $request->dFecha;


        if (is_null($dFecha) || is_null($nIdProveedor)) {

            $dato = Parteingreso::with('ordencompras', 'proveedor', 'motivo')->get();
            return $dato;
        }

        if ($nIdProveedor) {
            /*   $dato = Detalleparteingreso::with('parteingreso', 'Parteingreso.ordencompras', 'Parteingreso.proveedor', 'Parteingreso.motivo', 'Parteingreso.user')
                ->whereHas('Parteingreso', function (Builder $query) use ($nIdProveedor) {
                    $query->where('proveedor_id', $nIdProveedor);
                })->get();
                */
            $dato = Parteingreso::with('ordencompras', 'proveedor', 'motivo')->where('proveedor_id', $nIdProveedor)->orderBy('Fecha', 'desc')->get();
            return $dato;
        }

        if ($dFecha) {
            /*   $dato = Detalleparteingreso::with('parteingreso', 'Parteingreso.ordencompras', 'Parteingreso.proveedor', 'Parteingreso.motivo', 'Parteingreso.user')
                ->whereHas('Parteingreso', function (Builder $query) use ($fecha1, $fecha2) {
                    $query->whereBetween('Fecha', [$fecha1, $fecha2]);
                })->get(); */

            $dato = Parteingreso::with('ordencompras', 'proveedor', 'motivo')->where('Fecha', [$fecha1, $fecha2])->get();
            return $dato;
        }
    }

    public function ListParteIngresoxNroOrden(Request $request)
    {
        //$dato = Parteingreso::with('proveedor','motivo')->where('codigo',$request->Norden)->get();
        // $dato = DetalleParteIngreso::with('parteingreso', 'ordencompras', 'Parteingreso.proveedor', 'Parteingreso.motivo')->where('ordencompras_id', $request->Norden)->get();
        $codOrdCompras = Ordencompra::where('codigo', $request->Norden)->first();
        $dato = Parteingreso::with('ordencompras', 'proveedor', 'motivo')->where('ordencompras_id', $codOrdCompras->id)->get();
        return $dato;
    }

    public function ListParteIngresoxProduct(Request $request)
    {
        $dato = Detalleparteingreso::with('parteingreso', 'parteingreso.ordencompras', 'parteingreso.proveedor', 'parteingreso.motivo')->where('producto_id', $request->nIdprod)->get();
        return $dato;
    }

    public function ProveedorFechaPdf(Request $request)
    {
        // dd($request->get("params")['item']);
        $valor = $request->get("params")['item'];
        $PartI = Parteingreso::with('proveedor', 'ordencompras')->where('id', $valor)->first();
        $detPartI = Detalleparteingreso::with('parteingreso', 'producto', 'unidmedida')->where('parteingreso_id', $valor)->get();
        // dd($detPartI);
        $logo = asset('img/logo.gif');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteIngreso.ReporteProductFecha', [
            'logo' => $logo,
            'productos01' => $productos01,
            'PartI' => $PartI,
            'detPartI' => $detPartI,
        ]);

        return $pdf->download('invoice.pdf');
    }

    public function ProveedorOrdenCompraPdf(Request $request)
    {

        $valor = $request->get("params")['item'];
        $PartI = Parteingreso::with('proveedor', 'ordencompras')->where('ordencompras_id', $valor)->first();

        $detPartI = Detalleparteingreso::with('parteingreso', 'producto', 'unidmedida')->where('parteingreso_id', $PartI->id)->get();
        // dd($detPartI);
        $logo = asset('img/logo.gif');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteIngreso.ReporteProductFecha', [
            'logo' => $logo,
            'productos01' => $productos01,
            'PartI' => $PartI,
            'detPartI' => $detPartI,
        ]);

        return $pdf->download('invoice.pdf');
    }

    public function setSaveIngAlmacen(Request $request)
    {
        ///  Graba Parte de Ingreso  //////////////
        $user = User::where('id', $request->nIdUser)->first();
        $parteIngreso = new Parteingreso();
        $formatreq = date("Y-m-d");

        $formatYear = date("Y");
        // $date = Carbon::now();
        $countPIngreso = Parteingreso::count();


        $codPi = 'PI' . sprintf('%04d',  $countPIngreso + 1) . '-' . $formatYear;

        $parteIngreso->codigo =  $codPi;
        $parteIngreso->Nrofactura = mb_strtoupper($codPi);
        $parteIngreso->Nroguia = mb_strtoupper($codPi);
        $parteIngreso->ordencompras_id = 1;
        $parteIngreso->proveedor_id = 19;
        $parteIngreso->motivo_id = 11;
        $parteIngreso->Fecha = $formatreq;
        $parteIngreso->observacion = 'INGRESO DE SCTOCK' . '-' . $formatYear;
        $parteIngreso->user_id = $request->nIdUser;
        $parteIngreso->almacen_id = $request->nIdAlmacen;
        $parteIngreso->save();


        $detalleParteIngreso = new detalleParteIngreso;
        $detalleParteIngreso->parteingreso_id = $parteIngreso->id;
        $detalleParteIngreso->producto_id = $request->nIdprod;
        $detalleParteIngreso->cantidad = $request->cCantidad;
        $detalleParteIngreso->unidmedida_id =  $request->nIdUnidMed;
        $detalleParteIngreso->punit = $request->punit;
        $detalleParteIngreso->estado = '1';
        $detalleParteIngreso->save();

        $countKardex=Kardex::where('producto_id',$request->nIdprod)->count();
        if ($countKardex === 0){
            $kardex = new Kardex;
            $kardex->producto_id = $request->nIdprod;
            $kardex->stock = $request->cCantidad;
            $kardex->costunit = $request->punit;
            $kardex->diferencia = 0;
            $kardex->save();
        }else{
            $kardex = Kardex::where('producto_id',$request->nIdprod)->first();
            Kardex::where('producto_id', $request->nIdprod)->update(['stock' => $kardex->stock + $request->cCantidad]);
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

                    Producto::where('id', $request->nIdprod)->update(['stock' => $request->cCantidad]);
    }
}
