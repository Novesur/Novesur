<?php

namespace App\Http\Controllers\Administracion;

use App\Cotizacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\DetalleCotizacion;
use App\EstadoPedido;
use App\User;
use Illuminate\Support\Facades\Cache;



class DetalleCotizacionController extends Controller
{
    public function listProdByName(Request $request)
    {

        $dato = Cache::remember('product.all', 5, function () {
            return Producto::with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'estado', 'homologacion')->where('estado_id', 1)->get();
        });


        return $dato;
    }



    public function listDetCotizacionBy(Request $request)
    {
        $idcoti = Cotizacion::where('codigo', $request->item)->first();



        $dato = DetalleCotizacion::with('unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->where('cotizacion_id', $idcoti->id)->get();
        return $dato;
    }



    public function listEstadoCotizacion()
    {
        $dato = EstadoPedido::all();
        //$dato = EstadoPedido::orderBy('id')->get();
        return $dato;
    }

    public function CotizacionToPdf(Request $request)
    {
        $dato = DetalleCotizacion::with('cliente', 'user', 'tipopago', 'estadopedido')->whereBetween('id', [$request->nidCoti])->get();
        return $request;
    }

    public function DatosItemDetalleCotixItem(Request $request)
    {
        $dato = DetalleCotizacion::with('unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
            ->where('id', $request->item)
            ->first();
        return $dato;
    }

    public function EditDatosItem(Request $request)
    {
        //dd($request);


        $detalle = DetalleCotizacion::with('producto')->where('id', $request->item)->first();

        $producto = Producto::find($request->nIdprodEdit);

        $cotizacion = Cotizacion::with('cliente')->where('id', $detalle->cotizacion_id)->first();

        $rol = User::where('id',$request->nIdUsuario)->first();


        if ($cotizacion->cliente->tipoPrecio == 'Lista') {

            if ($request->cCantidadEdit == 0) {
                return response()->json(['message' => 'Valor no Permitido', 'icon' => 'error'], 200);
            }


      
          /*   if($rol->roles_id === 1 || $rol->roles_id === 9 || $rol->roles_id === 5 || $rol->roles_id === 4){ */
            if($rol->roles_id === 1 ||  $rol->roles_id === 5 ){
                DetalleCotizacion::where('id', $request->item)
                ->update([
                    'cantidad' => $request->cCantidadEdit,
                    'unidmedida_id' => $request->nIdUnidMedEdit,
                    'producto_id' => $request->nIdprodEdit,
                    'punit' =>   $request->cPUnitEdit,
                ]);
            return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
            }

            if (empty($producto->precioSugerido) || $producto->precioSugerido == 0) {
                DetalleCotizacion::where('id', $request->item)
                    ->update([
                        'cantidad' => $request->cCantidadEdit,
                        'unidmedida_id' => $request->nIdUnidMedEdit,
                        'producto_id' => $request->nIdprodEdit,
                        'punit' =>   $request->cPUnitEdit,
                    ]);
                return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
            }


          
            if ($producto->precioSugerido > $request->cPUnitEdit) {
                DetalleCotizacion::where('id', $request->item)
                    ->update([
                        'cantidad' => $request->cCantidadEdit,
                        'unidmedida_id' => $request->nIdUnidMedEdit,
                        'producto_id' => $request->nIdprodEdit,
                        'punit' =>   $detalle->punit,
                    ]);
                return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
            } else {
                DetalleCotizacion::where('id', $request->item)
                    ->update([
                        'cantidad' => $request->cCantidadEdit,
                        'unidmedida_id' => $request->nIdUnidMedEdit,
                        'producto_id' => $request->nIdprodEdit,
                        'punit' =>   $request->cPUnitEdit,
                    ]);
                return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
            }




            /*         if($producto->precioDistribuidor > 0 ){
            if($producto->precioDistribuidor < $request->cPUnitEdit){

            return response()->json(['message' => 'El monto minimo es' . ' ' . $producto->precioSugerido, 'icon' => 'error'],200);
        }else{
            DetalleCotizacion::where('id', $request->item)
            ->update([
                'cantidad' => $request->cCantidadEdit,
        'unidmedida_id' => $request->nIdUnidMedEdit,
        'producto_id' => $request->nIdprodEdit,
        'punit' =>   $request->cPUnitEdit,
            ]);
        }
        return response()->json(['message' => 'Detalle editado', 'icon' => 'success'],200);
    } */
        }


        if ($cotizacion->cliente->tipoPrecio == 'Distribuidor') {


            if ($request->cCantidadEdit == 0) {
                return response()->json(['message' => 'Valor no Permitido', 'icon' => 'error'], 200);
            }

            if ($producto->precioDistribuidor == '' || $producto->precioDistribuidor == 0) {
                DetalleCotizacion::where('id', $request->item)
                    ->update([
                        'cantidad' => $request->cCantidadEdit,
                        'unidmedida_id' => $request->nIdUnidMedEdit,
                        'producto_id' => $request->nIdprodEdit,
                        'punit' =>   $request->cPUnitEdit,
                    ]);
                return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
            }




            if ($detalle->producto->precioDistribuidor > $request->cPUnitEdit) {
              DetalleCotizacion::where('id', $request->item)
                    ->update([
                        'cantidad' => $request->cCantidadEdit,
                        'unidmedida_id' => $request->nIdUnidMedEdit,
                        'producto_id' => $request->nIdprodEdit,
                        'punit' =>   $detalle->punit,
                    ]);
            } else {
                DetalleCotizacion::where('id', $request->item)
                    ->update([
                        'cantidad' => $request->cCantidadEdit,
                        'unidmedida_id' => $request->nIdUnidMedEdit,
                        'producto_id' => $request->nIdprodEdit,
                        'punit' =>   $request->cPUnitEdit,
                    ]);
            }
            return response()->json(['message' => 'Detalle editado', 'icon' => 'success'], 200);
        }
    }

    public function listDetCotibyId(Request $request)
    {
        $dato = DetalleCotizacion::with('unidmedida', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
            ->where('cotizacion_id', $request->nIdCotizacion)
            ->where('EstadoNotPedido', '1')
            ->get();
        return $dato;
    }
}
