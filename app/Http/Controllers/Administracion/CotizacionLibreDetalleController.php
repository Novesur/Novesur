<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CotizacionLibre;
use App\CotizacionLibreDetalle;

class CotizacionLibreDetalleController extends Controller
{
    public function listDetCotizacionBy(Request $request)
    {
        $idcoti = CotizacionLibre::where('codigo', $request->item)->first();
        $dato = CotizacionLibreDetalle::with('unidmedida')->where('cotizacionlibre_id', $idcoti->id)->get();
        return $dato;
    }

    public function DatosItemDetalleCotixItem(Request $request)
    {
        $dato = CotizacionLibreDetalle::with('unidmedida')
            ->where('id', $request->item)
            ->first();
        return $dato;
    }


    public function EditDatosItem(Request $request)
    {
        //dd($request);

        $detalle = CotizacionLibreDetalle::where('id', $request->item)->first();

        $CotizacionLibre = CotizacionLibre::with('cliente')->where('id', $detalle->cotizacion_id)->first();

            CotizacionLibreDetalle::where('id', $request->item)
            ->update([
                'cantidad' => $request->cCantidadEdit,
                'unidmedida_id' => $request->nIdUnidMedEdit,
                'producto' => $request->nIdprodEdit,
                'punit' =>   $request->cPUnitEdit,
            ]);
        return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
    }
}
