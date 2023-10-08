<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleKardex;
use App\Detallepartesalida;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\Partesalida;
use App\Producto;
use App\TempPSalida;
use App\UnidMedida;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use PDF;

class ParteSalidaController extends Controller
{
    public function GrabarPSalida(Request $request)
    {


      /*     try {
            if ($request->session()->has('psalida')) {
                DB::beginTransaction(); */
                $date = Carbon::now();
                $date = Carbon::parse($request->cFecha)->format('Y-m-d');



                /*    $pSalida = new Partesalida(['codigo' => $codPs,'cliente_id' => $request->nIdCliente, 'Nrofactura' => $request->nroFactura, 'Nroguia' => $request->nroguia, 'motivo_id' => $request->nIdMotivo, 'Fecha' => $date, 'observacion' => $request->cobservacion, 'user_id' => $request->nIdUser, 'estadoparte_id' => 1]);
                $pSalida->save(); */


                $listPartSalida = Partesalida::all();
                $lastcod = $listPartSalida->last();



                $countPSalida = Partesalida::count();
                $estado = 1;
                if($countPSalida == 0){
                    $codPs = '0001'.'-'. Carbon::parse($request->cFecha)->format('Y');
                }else{
                    $codPs = sprintf('%04d', intval($lastcod->id) + 1) .'-'. Carbon::parse($request->cFecha)->format('Y');
                };

                $pSalida = new Partesalida();
                $pSalida->codigo = $codPs;
                $pSalida->cliente_id = $request->nIdCliente;
                $pSalida->Nrofactura = $request->nroFactura;
                $pSalida->Nroguia = $request->nroguia;
                $pSalida->motivo_id = $request->nIdMotivo;
                $pSalida->Fecha = $date;
                $pSalida->observacion = $request->cobservacion;
                $pSalida->user_id = $request->nIdUser;
                $pSalida->estadoparte_id = $estado;
                $pSalida->save();


                $detpsalida = Session::get('psalida');
                $allpsalida = $detpsalida->map(function ($product) use ($pSalida) {
                    return [
                        'partesalida_id' => $pSalida->id,
                        'cantidad'      => $product->cantidad,
                        'unidmedida_id' => $product->unidmedida_id,
                        'producto_id'   => $product->producto_id,
                    ];
                });
                $allpsalida = $allpsalida->toArray();
                Detallepartesalida::insert($allpsalida);
                
                foreach ($allpsalida as $item ) {
                    $temp = (object)$item;
                    $kardex = Kardex::where('producto_id', $temp->producto_id)->first();
                    $kardex->producto_id = $temp->producto_id;
                    $kardex->stock = $kardex->stock - $temp->cantidad;
                    $kardex->costunit =  $kardex->costunit;
                    $kardex->diferencia =  NULL;
                    $kardex->save();

                    $DetalleKardex = New DetalleKardex();
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

                Session::put('psalida', collect([]));

                /* DB::commit(); */
                return response()->json(['message' => 'Grabado con exitos', 'icon' => 'success'], 200);
          /*   } else {
                return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
            } */
     /*     } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['debug' => $e->getMessage(),'message' => 'Verifique bien los valores ingresador por favor', 'icon' => 'warning'], 200);
        } */
    }

    public function eliminarTempitemPartS()
    {
        Session::put('psalida', null);
        $dato = session()->get('psalida') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function AddTempParteSalida(Request $request)
    {

        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $psalida = Session::get('psalida');
        $psalida = ($psalida != null) ? collect($psalida) : collect([]);
        $exists = $psalida->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $psalida, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $temppSalida = new TempPSalida;
            if ($request->cCantidad <= $request->cStock) :
                $temppSalida->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
                $psalida->push($temppSalida);
                Session::put('psalida', $psalida);
                return response()->json(['datos' => $psalida, 'message' => NULL]);
            else :
                return response()->json(['message' => 'Excede al stock actual', 'icon' => 'info'], 200);
            endif;
        endif;
    }

    public function reorder(Request $request)
    {
        $id = (int)trim($request->item);
        $items = session()->get('psalida') ?? collect([]);
        $exits = $items->firstWhere("producto_id", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto_id", [$id]);
            session()->put('psalida', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public  function ListtempParteSalida()
    {
        $dato = session()->get('psalida') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function eliminarTempitemPSalida()
    {
        Session::put('psalida', null);
        $dato = session()->get('psalida') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function getListarPartesalidaFecha(Request $request){

            $dato = Partesalida::with('cliente')->whereBetween("Fecha",[$request->fecha1, $request->fecha2])->get();
            return $dato;

    }


    public function getListarPartesalidaCliente(Request $request){

            $dato = Partesalida::with('cliente')->where("cliente_id", $request->nIdCliente)->get();
            return $dato;

    }

    public function reporteParteSalidaPdf(Request $request){

        $valor = $request->get("params")['item'];

        $parteSalida = Partesalida::with('cliente','motivo','user')->where('id',$valor)->first();
        $detalleParteSalida = Detallepartesalida::with('producto','unidmedida')->where('partesalida_id',$valor)->get();
        $logo = asset('img/logo02.png');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteSalida.reporte', [
            'logo' => $logo,
            'productos01' => $productos01,
            'parteSalida' => $parteSalida,
            'detalleParteSalida' => $detalleParteSalida,
        ]);
        return $pdf->download('invoice.pdf');
 }
}

