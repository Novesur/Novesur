<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetalleCotizacion;
use App\Cotizacion;
use App\Notapedido;
use App\DetalleNotapedido;
use App\Countable;
use PDF;


class NotaPedidoController extends Controller
{
    public function delete(Request $request){
    
        $detalleCotizacion = DetalleCotizacion::where('id', $request->idDetCoti)
        ->where('EstadoNotPedido', '1')->first();
        $detalleCotizacion->EstadoNotPedido = '0';
        $detalleCotizacion->save(); 
 
    }

    public function create(Request $request){

       $infoCotizacion = Cotizacion::where('id', $request->nIdCotizacion)->first();
       //$maxidNotPedido = Notapedido::whereRaw('id = (select max(`id`) from notapedidos)')->first();
       $countable = Countable::all();
       $maxidNotPedido = $countable[0]->countnotapedido;
      
      
       $yearMaxID = date("Y");
       if ($maxidNotPedido == 0) {
           $maxidNotPedido = '0001'. '-' . $yearMaxID;
       } else {
           $maxidNotPedido = sprintf('%04d', $maxidNotPedido + 1) . '-' . $yearMaxID;
       }
       $formatreq = date("Y-m-d");
       $notapedido = new Notapedido();
       $notapedido->codigo = $maxidNotPedido;
       $notapedido->cotizacion_id = $request->nIdCotizacion;
       $notapedido->fecha = $formatreq;
       $notapedido->cliente_id = $infoCotizacion->cliente_id;
       $notapedido->vendedor_id = $infoCotizacion->user_id;
       $notapedido->validezoferta = $infoCotizacion->validezoferta;
       $notapedido->Entrega = $infoCotizacion->Entrega;
       $notapedido->tipopago_id = $infoCotizacion->tipopago_id;
       $notapedido->pago_id = $infoCotizacion->pago_id;
       $notapedido->flete = $infoCotizacion->flete;
       $notapedido->documentacion = $infoCotizacion->documentacion;
       $notapedido->garantia_id = $infoCotizacion->garantia_id;
       $notapedido->punto_llegada = $request->cPuntoLlegada;
       $notapedido->transporte = $request->cTransporte;
       $notapedido->consignado = $request->Cconsignado;
       $notapedido->observacion = $infoCotizacion->observacion;
       $notapedido->user_id = $request->vidUSer;
       $notapedido->save();
       
       ////GRABA DETALLE NOTAPEDIDOS
   
       $detalleCotizacion = DetalleCotizacion::where(
        ['cotizacion_id' => $request->nIdCotizacion,
         'EstadoNotPedido' => '1' 
         ])->get();

         foreach ($detalleCotizacion as $dataCotizacion) {
            $detalleNotapedido = new DetalleNotapedido();
            $detalleNotapedido->notapedidos_id = $notapedido->id;
            $detalleNotapedido->cantidad = $dataCotizacion->cantidad;
            $detalleNotapedido->unidmedida_id = $dataCotizacion->unidmedida_id;
            $detalleNotapedido->producto_id = $dataCotizacion->producto_id;
            $detalleNotapedido->save();
            Countable::where('id', 1)->update(['countnotapedido' => $notapedido->id]);

         }

       return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
    }

    public function list(Request $request){

       
        $fecha = $request->fecha;
        $nIdRSocial = $request->nIdRSocial;
        $nIdvendedor = $request->nIdvendedor;
        $cNroNota = $request->cNroNota;

if($request->fecha == null &&  $request->nIdRSocial == null && $request->nIdvendedor == null && $request->cNroNota == null){
    $dato = Notapedido::with('vendedor','cliente','cotizacion')->get();
            return $dato;
}

        if($fecha){
            $dato = Notapedido::with('vendedor','cliente','cotizacion')->whereBetween('fecha',[$request->fecha1,$request->fecha2])->get();
            return $dato;
        }

        if($nIdRSocial){
            $dato = Notapedido::with('vendedor','cliente','cotizacion')->where('cliente_id',$request->nIdRSocial)->get();
            return $dato;
        }

        if($nIdvendedor){
            $dato = Notapedido::with('vendedor','cliente','cotizacion')->where('vendedor_id',$request->nIdvendedor)->get();
            return $dato;
        }
        if($cNroNota){
            $dato = Notapedido::with('vendedor','cliente','cotizacion')->where('codigo',$request->cNroNota)->get();
            return $dato;
        }

        

    }

    public function listNotaPedidoBy(Request $request){ 
      
        $data = DetalleNotapedido::with('producto','producto.marca','producto.familia','producto.material','producto.modelotipo','producto.subfamilia','producto.homologacion')
        ->where('notapedidos_id', $request->item)->get();

        return $data;
    }

    public function NotaPedidoPdf(Request $request){


        $id = $request->get("params")['id'];
            $Notapedido = Notapedido::with('vendedor','cliente','cotizacion')->where('id',$id)->first();
            $detalleNotapedido = DetalleNotapedido::with('producto','producto.marca','producto.familia','producto.material','producto.modelotipo','producto.subfamilia','producto.homologacion')
            ->where('notapedidos_id', $id)->get();
            $logo = asset('img/logo.gif');
            $productos01 = asset('img/banner01.png');
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.notapedido.reportepdf', [
                'logo' => $logo,
                'productos01' => $productos01,
                'Notapedido' => $Notapedido,
                'detalleNotapedido' => $detalleNotapedido,
            ]);
            return $pdf->download('invoice.pdf');
    }


    public function editcantDetNotaPedido(Request $request){
        DetalleNotapedido::where('id', $request->id)->update(['cantidad' => $request->vcant]);
    }
       
  

}
