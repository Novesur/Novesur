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
            ->where('estado', 2)
            ->whereHas('ordencompras', function (Builder $query) use ($cOrdenComPra) {
                $query->where('codigo', $cOrdenComPra);
            })->get();
        return $dato;
    }

    public function CambiarEstadoDetalleOC(Request $request)
    {

        //dd($request);
        //$Oc= Ordencompra::where('id', $request->nIdOC)->first();


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
        $parteIngreso->save();

        /// Graba Parte de DetalleParteIngreso  //////////////

        $DOc = Detalleordencompra::where('ordencompras_id', $Oc->id)->where('estado', 1)->get();
    
        if ($DOc) {
            foreach ($DOc as  $datOc) {
                $detalleParteIngreso = new detalleParteIngreso;
                $detalleParteIngreso->parteingreso_id = $parteIngreso->id;
                $detalleParteIngreso->producto_id = $datOc->producto_id;

              

                if($datOc->cantidadKardex === '0.00'){
                    $detalleParteIngreso->cantidad = 0;
                    Detalleordencompra::where('id', $datOc->id)->update(['estado' => '1']);
                }

                if (($datOc->cantidad - $datOc->cantidadKardex) === '0.00'){
                    $detalleParteIngreso->cantidad = $datOc->cantidad;
                    Detalleordencompra::where('id', $datOc->id)->update(['estado' => '1']);
                }

                if(($datOc->cantidad - $datOc->cantidadKardex) !== '0.00'){
                    $detalleParteIngreso->cantidad = ($datOc->cantidad - $datOc->cantidadKardex);
                    Detalleordencompra::where('id', $datOc->id)->update(['estado' => '2']);
                }


            
                $detalleParteIngreso->unidmedida_id =  $datOc->unidmedida_id;
                $detalleParteIngreso->punit = $datOc->punit;
                $detalleParteIngreso->save();


                $formatreq = date("Y-m-d");
                $reporteParteIng = new ReporteParteIngreso;

            }
        }



        /*        $listpermiso = $request->listCompletFilter;
        
        $listpermisoSize = sizeof($listpermiso);

        if ($listpermisoSize > 0) {

            foreach ($listpermiso as $key =>  $value) {
                if ($value['cantidadKardex'] > 0) {
                    $detalleParteIngreso = new detalleParteIngreso;
                    $detalleParteIngreso->parteingreso_id = $parteIngreso->id;
                    $detalleParteIngreso->producto_id = $value['producto_id'];
                    if($value['estado'] === 1){
                        $detalleParteIngreso->cantidad = $value['cantidad']- $value['cantidadKardex'];

                    }else{
                        $detalleParteIngreso->cantidad = $value['cantidad'];
                    }
                    $detalleParteIngreso->unidmedida_id = $value['unidmedida_id'];
                    $detalleParteIngreso->punit = $value['punit'];
                    $detalleParteIngreso->save();

                    $formatreq = date("Y-m-d");
                    $reporteParteIng = new ReporteParteIngreso;
                    $reporteParteIng->ordencompras_id = $Oc->id;
                    $reporteParteIng->parteingreso_id = $parteIngreso->id;
                    $reporteParteIng->producto_id = $value['producto_id'];
                    $reporteParteIng->fecha = $formatreq;
                    dd($value['estado']);
                    if($value['estado'] == 1){
                        $reporteParteIng->cantidad = $value['cantidad']- $value['cantidadKardex'];

                    }else{
                        $reporteParteIng->cantidad = $value['cantidad'];
                    }

                    $idDetCompra = $value['iddetalleOrdenCompra'];

                    if ($value['cantidad'] - $value['cantidadKardex'] <= 0){

                        Detalleordencompra::where('id', $idDetCompra)->update(['estado' => '1']);
                    }

                    
                    $reporteParteIng->save();

                }
            } 
        }*/


        return response()->json(['message' => 'Grabado con exitos', 'icon' => 'success'], 200);
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
        $detPartI = Detalleparteingreso::with('parteingreso', 'producto', 'unidmedida')->where('parteingreso_id', $valor)->where('estado', 1)->get();
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

        $detPartI = Detalleparteingreso::with('parteingreso', 'producto', 'unidmedida')->where('parteingreso_id', $PartI->id)->where('estado', 1)->get();
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









        //dd($request->get("params")['item']);
        /* 
        $valor = $request->get("params")['item'];
        $idOrdenCompra = Detalleparteingreso::where('ordencompras_id',  $valor)->first();
        $PartI = Parteingreso::with('proveedor','ordencompras')->where('id', $idOrdenCompra->parteingreso_id)->first();
        // dd($valor); // = 1
        $CodOrdCompra = Detalleparteingreso::with('ordencompras')->where('ordencompras_id', $valor)->first();
        //dd( $CodOrdCompra );
        $detPartI = Detalleparteingreso::with('parteingreso', 'ordencompras')->where('ordencompras_id', $valor)->first();
        
        $detalleOrdenCompra =  Detalleordencompra::with('producto', 'unidmedida', 'producto.familia', 'producto.subfamilia', 'producto.modelotipo', 'producto.marca', 'producto.material', 'producto.homologacion')
        ->where('ordencompras_id', $detPartI->ordencompras_id)
        ->where('estado', '2')->get();

        $logo = asset('img/logo.gif');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteIngreso.ReporteNroOrden', [
            'logo' => $logo,
            'productos01' => $productos01,
            'PartI' => $PartI,
            'CodOrdCompra' => $CodOrdCompra,
            'detalleOrdenCompra' => $detalleOrdenCompra,
        ]);

        return $pdf->download('invoice.pdf'); */
    }
}
