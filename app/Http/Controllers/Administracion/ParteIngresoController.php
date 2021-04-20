<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleKardex;
use App\Http\Controllers\Controller;
use App\Kardex;
use Illuminate\Http\Request;
use App\Producto;
use App\UnidMedida;
use Illuminate\Support\Facades\Session;
use App\TempPIngreso;
use Exception;
use Illuminate\Support\Facades\DB;

class ParteIngresoController extends Controller
{
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

    public function setGrabaPIngreso(Request $request){

       $formatFecha= substr($request->cFecha,0,10);
        try{
            DB::beginTransaction();
            $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
            $detPIngreso = Session::get('pingreso');
            $detPIngreso = ($detPIngreso != null) ? collect($detPIngreso) : collect([]);
            foreach($detPIngreso as $item):
                $kardex = Kardex::where(['producto_id' => $item->producto_id])->first();


                if(!empty($kardex)):

                    $kardex->fill(['stock' => ((int)$kardex->stock +  (int)$item->cantidad), 'costunit' => $item->punit])->save();
                   //$kardex->fill(['stock' => ((int)$kardex->stock +  (int)$item->cantidad)])->save();
                   //return response()->json(['message' => 'Parte de Ingreso creado ', 'icon' => 'success', ], 200);
                else:
                     $kardex = new Kardex(['stock' => ((int)$item->cantidad), 'costunit' => $item->punit, 'producto_id' => $item->producto_id, 'diferencia' => NULL]);
                    $kardex->save();

                endif;
                $detallekardex = new DetalleKardex();
                $detallekardex->kardex_id =  $kardex->id;
                $detallekardex->fecha =  $formatFecha;
                $detallekardex->FactNo =  $request->cNumFactura;
                $detallekardex->GuiaNo =  $request->cNumGuia;
                $detallekardex->proveedor_id =  $request->nIdProveedor;
                $detallekardex->motivo_id =  '2';
                $detallekardex->unidmedida_id =  $request->nIdUnidMed;
                $detallekardex->cantidad =  $item->cantidad;
                $detallekardex->costunit =  $item->punit;
                $detallekardex->movimiento_id =  1;
                $detallekardex->user_id =  $request->nIdUser;
                $detallekardex->cliente_id =  '1';
                $detallekardex->save();


            endforeach;

            DB::commit();
            Session::put('pingreso', null);
            return response()->json(['message' => null], 200);
        }catch(Exception $execption){
            DB::rollback();
            return response()->json(['message' => 'Ocurrio un error en el proceso', 'icon' => 'error', 'debug' => $execption->getMessage()], 200);
        }
    }

}
