<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordenservicio;
use App\Http\Controllers\Controller;
use App\Ordenservicio;
use Illuminate\Http\Request;

class DetalleOrdenServicioController extends Controller
{
    public function view(Request $request)
    {


        $dato = Detalleordenservicio::with('ordenservicio', 'unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('ordenservicio_id', $request->item)->get();
        return $dato;
    }

    public function viewDetalleOrdenServicio(Request $request)
    {

        $ordenServicio = Ordenservicio::where('codigo', $request->item)->first();
        $dato = Detalleordenservicio::with('ordenservicio', 'unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('ordenservicio_id', $ordenServicio->id)->get();
        return $dato;
    }

    public function addOrdenEdit(Request $request)
    {


        $ordenServicio = Ordenservicio::where('codigo', $request->nidOrdenServicio)->first();
        $detalleOrdenServicioData = Detalleordenservicio::where('ordenservicio_id', $ordenServicio->id)->first();

        $ordenServicio->codigo =  $ordenServicio->codigo;
        $ordenServicio->Femision =  $ordenServicio->Femision;
        $ordenServicio->Referencia =  $ordenServicio->Referencia;
        $ordenServicio->proveedor_id =  $ordenServicio->proveedor_id;
        $ordenServicio->Fentrega =  $ordenServicio->Fentrega;
        $ordenServicio->LugarEntrega =  $request->cLEntrega;
        $ordenServicio->pago_id =  $request->nIdTipoPago;
        $ordenServicio->user_id =  $ordenServicio->user_id;
        $ordenServicio->estadoordencompra_id =  $ordenServicio->estadoordencompra_id;
        $ordenServicio->observacion =  $request->cObservacion;
        $ordenServicio->tipocambio_id =  $ordenServicio->tipocambio_id;


        $ordenServicio->save();

        $detalleOrdenServicio = new Detalleordenservicio();
        $detalleOrdenServicio->ordenservicio_id = $ordenServicio->id;
        $detalleOrdenServicio->producto_id = $request->nIdprod;
        $detalleOrdenServicio->cantidad = $request->cCantidad;
        $detalleOrdenServicio->cantidadKardex = 0;
        $detalleOrdenServicio->unidmedida_id = $request->nIdUnidMed;
        $detalleOrdenServicio->punit = $request->cPrecio;
        $detalleOrdenServicio->estado =  $detalleOrdenServicioData->estado;
        $detalleOrdenServicio->canting =  0;
        $detalleOrdenServicio->save();
    }

    public function CargaDetalleOrdenServicioEdit(Request $request)
    {

        $data = Detalleordenservicio::find($request->item);
        return $data;
    }

    public function ModalSaveItemsDetalleOS(Request $request)
    {
        $detalleOrdenServicio = Detalleordenservicio::find($request->id);
        $detalleOrdenServicio->ordenservicio_id = $detalleOrdenServicio->ordenservicio_id;
        $detalleOrdenServicio->producto_id = $request->nIdprodEdit;
        $detalleOrdenServicio->cantidad = $request->cCantidadEdit;
        $detalleOrdenServicio->cantidadKardex = $request->cCantidadEdit;
        $detalleOrdenServicio->unidmedida_id = $request->nIdUnidMedEdit;
        $detalleOrdenServicio->punit = $request->cPUnitEdit;
        $detalleOrdenServicio->estado = $detalleOrdenServicio->estado;
        $detalleOrdenServicio->canting =  0;
        $detalleOrdenServicio->save();
    }

    public function DeleteItemDetalleOrdenServicio(Request $request)
    {
        $detalle = Detalleordenservicio::find($request->item);
        $detalle->delete();
    }

    public function setMandarValorDetalleParteSalidaXId(Request $request)
    {
        $dato = Detalleordenservicio::where('id', $request->item)->first();

        return $dato;
    }

    public function setAddCantidadParteSali(Request $request)
    {

        $detalleOs = Detalleordenservicio::where('id', $request->item)->first();
        $cCantidadModal = $request->cCantidadModal;


        if ($cCantidadModal > $detalleOs->cantidad ) {
            return response()->json(['message' => 'Cantidad menos de lo permitido', 'icon' => 'info'], 200);
        }

        if ($cCantidadModal <= 0 ) {
            return response()->json(['message' => 'Valor no permitido', 'icon' => 'info'], 200);
        } else {
            Detalleordenservicio::where('id', $request->item)->update(['canting' => $cCantidadModal]);
        }
        return response()->json(['message' => 'cantidad agregada', 'icon' => 'success'], 200);
    }
}
