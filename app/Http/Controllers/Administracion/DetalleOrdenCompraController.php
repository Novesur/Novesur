<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordencompra;
use App\Http\Controllers\Controller;
use App\Ordencompra;
use Illuminate\Http\Request;

class DetalleOrdenCompraController extends Controller
{
    public function view(Request $request)
    {
        $ordencompra = Ordencompra::where('codigo', $request->item)->first();
        $dato = Detalleordencompra::with('ordencompras', 'unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')
            ->where('ordencompras_id', $ordencompra->id)
            ->get();
        return $dato;
    }

    public function viewModal(Request $request)
    {
        $ordencompra = Ordencompra::where('id', $request->item)->first();
        $dato = Detalleordencompra::with('ordencompras', 'unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')
            ->where('ordencompras_id', $ordencompra->id)
            ->get();
        return $dato;
    }

    public function CambiarEstadoDetalleOC(Request $request)
    {
        /*    $ordenCompra = Ordencompra::where('id',$request->nIdDetalleOC)->first();
         $ordenCompra->estado = $request->cEstado -> save(); */

        $DetalleOC = Detalleordencompra::where('id', $request->nIdDetalleOC)->first();
        if ($DetalleOC) {
            $DetalleOC->ordencompras_id = $DetalleOC->ordencompras_id;
            $DetalleOC->producto_id = $DetalleOC->producto_id;
            $DetalleOC->cantidad = $DetalleOC->cantidad;
            $DetalleOC->cantidadKardex = $DetalleOC->cantidadKardex;
            $DetalleOC->unidmedida_id = $DetalleOC->unidmedida_id;
            $DetalleOC->punit = $DetalleOC->punit;
            $DetalleOC->estado = $request->cEstado;
            $DetalleOC->canting = 0;
            $DetalleOC->save();
        }
    }
    public function setMandarValorDetalleParteIngresoXId(Request $request)
    {
        $dato = Detalleordencompra::where('id', $request->item)->first();
        return $dato;
    }

    public function setAddCantidadParteIngre(Request $request)
    {
        $detalleOc = Detalleordencompra::where('id', $request->item)->first();
        $cCantidadModal = $request->cCantidadModal;

        
        if ($cCantidadModal > $detalleOc->cantidad ) {
            return response()->json(['message' => 'Cantidad menos de lo permitido', 'icon' => 'info'], 200);
        }
        if ($cCantidadModal <= 0) {
            return response()->json(['message' => 'Valor no permitido', 'icon' => 'info'], 200);
        } else {
            Detalleordencompra::where('id', $request->item)->update(['canting' => $cCantidadModal]);
      /*       Detalleordencompra::where('id', $request->item)->update(['cantidadKardex' => $cCantidadModal + intval($detalleOc->canting)]); */
            //Detalleordencompra::where('id', $request->item)->update(['cantidadKardex' => $cCantidadModal + $detalleOc->canting]);
        }
        $detalleOc = Detalleordencompra::where('id', $request->item)->first();
/* 
        if ($detalleOc->cantidad == $detalleOc->cantidadKardex) {
            Detalleordencompra::where('id', $request->item)->update(['estado' => '1']);
        } */
        return response()->json(['message' => 'cantidad agregada', 'icon' => 'success'], 200);
    }


    public function editCantComplete(Request $request)
    {
        if ($request->checked === true) {
            Detalleordencompra::where('id', $request->iddetalleOrdenCompra)->update(['grabado' => '1']);
        }

        if ($request->checked === false) {
            Detalleordencompra::where('id', $request->iddetalleOrdenCompra)->update(['grabado' => '0']);
        }
    }

    public function addOrdenEdit(Request $request)
    {
        $ordenCompra = Ordencompra::where('codigo', $request->nidOrdenCompra)->first();
        $detalleOrdenCompraData = Detalleordencompra::where('ordencompras_id', $ordenCompra->id)->first();

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
        $ordenCompra->tipocambio_id = $ordenCompra->tipocambio_id;

        $ordenCompra->save();

        $detalleOrdenCompra = new Detalleordencompra();
        $detalleOrdenCompra->ordencompras_id = $ordenCompra->id;
        $detalleOrdenCompra->producto_id = $request->nIdprod;
        $detalleOrdenCompra->cantidad = $request->cCantidad;
        $detalleOrdenCompra->cantidadKardex = 0;
        $detalleOrdenCompra->unidmedida_id = $request->nIdUnidMed;
        $detalleOrdenCompra->punit = $request->cPrecio;
        $detalleOrdenCompra->estado = $detalleOrdenCompraData->estado;
        $detalleOrdenCompra->canting = 0;
        $detalleOrdenCompra->save();
    }

    public function DeleteItemDetalleOrdenCompra(Request $request)
    {
        $detalle = Detalleordencompra::find($request->item);
        $detalle->delete();
    }

    public function CargaDetalleOrdenCompraEdit(Request $request)
    {
        $data = Detalleordencompra::find($request->item);
        return $data;
    }

    public function ModalSaveItemsDetalleOC(Request $request)
    {
        $detalleOrdenCompra = Detalleordencompra::find($request->id);
        $detalleOrdenCompra->ordencompras_id = $detalleOrdenCompra->ordencompras_id;
        $detalleOrdenCompra->producto_id = $request->nIdprodEdit;
        $detalleOrdenCompra->cantidad = $request->cCantidadEdit;
        $detalleOrdenCompra->cantidadKardex = $detalleOrdenCompra->cantidadKardex;
        $detalleOrdenCompra->unidmedida_id = $request->nIdUnidMedEdit;
        $detalleOrdenCompra->punit = $request->cPUnitEdit;
        $detalleOrdenCompra->estado = $detalleOrdenCompra->estado;
        $detalleOrdenCompra->canting = 0;
        $detalleOrdenCompra->save();
    }
}
