<?php

namespace App\Http\Controllers\Administracion;

use App\Producto;
use App\TempProyectoMateriales;
use App\UnidMedida;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\ProyectoMateriales;
use App\ProyectoReqMateriales;
use Illuminate\Http\Request;

class ProyectoMaterialesController extends Controller
{

    public function addReqMatProyReq(Request $request)
    {
        $formatreq = date("Y-m-d");
        $ProyectoReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->first();
        $ProyectoMateriales = new ProyectoMateriales();
        $ProyectoMateriales->pk_proyecto_reqmateriales = $ProyectoReqMateriales->id;
        $ProyectoMateriales->producto_id = $request->nIdmaterial;
        $ProyectoMateriales->cantidad = $request->cCantMaterial;
        $ProyectoMateriales->unidmedida_id = $request->nIdUnidMedMat;
        $ProyectoMateriales->cantInfoValor = $request->cCantMaterial;
        $ProyectoMateriales->unidmedidaInfoValor_id = $request->nIdUnidMedMat;
        $ProyectoMateriales->fecha = $formatreq;
        $ProyectoMateriales->estado = $request->estado;
        $ProyectoMateriales->save();
    }

    public function listproyMateriales(Request $request)
    {

        $idproyReqMateriales = ProyectoReqMateriales::where('codigo', $request->codRequMateriales)->first();
        $dato = ProyectoMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->where('pk_proyecto_reqmateriales', $idproyReqMateriales->id)->get();
        return $dato;
    }
    public function addOrden(Request $request)
    {

        $product = Producto::where(['id' => $request->nIdmaterial])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('proyectoMaterial');
        $products = ($products != null) ? collect($products) : collect([]);

        $unidMedida = UnidMedida::where('id', $request->nIdUnidMedMat)->first();

        if ($request->cCantMaterial == 0) {
            return response()->json(['message' => 'El valor no puede ser cero', 'icon' => 'error'], 200);
        }


        $exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $tempOrder = new TempProyectoMateriales();
            $tempOrder->fill(['cantidad' => $request->cCantMaterial,  'codigo' => $product->codigo, 'producto_id' => $request->nIdmaterial,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre, 'unidMedida' => $unidMedida->nombre, 'unidMedida_id' => $unidMedida->id, 'estado' => $request->estado]);
            $products->push($tempOrder);
            Session::put('proyectoMaterial', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);
        endif;
    }

    public  function eliminarTemporder()
    {
        Session::put('proyectoMaterial', null);
        $dato = session()->get('proyectoMaterial') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function reorderReqMateriales(Request $request)
    {

        $id = (int)trim($request->item);
        $items = session()->get('proyectoMaterial') ?? collect([]);
        $exits = $items->firstWhere("producto_id", $id);

        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto_id", [$id]);
            session()->put('proyectoMaterial', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public function SaveMatReqMatProy(Request $request)
    {
        
        $formatreq = date("Y-m-d");
        $ProyectoMateriales = new ProyectoMateriales();
        $ProyectoMateriales->pk_proyecto_reqmateriales = $request->idproy;
        $ProyectoMateriales->producto_id = $request->nIdmaterial;
        $ProyectoMateriales->cantidad = $request->cCantMaterial;
        $ProyectoMateriales->unidmedida_id = $request->nIdUnidMedMat;
        $ProyectoMateriales->cantInfoValor = $request->cCantMaterial;
        $ProyectoMateriales->unidmedidaInfoValor_id = $request->nIdUnidMedMat;
        $ProyectoMateriales->fecha = $formatreq;
        $ProyectoMateriales->estado = 'R';
        $ProyectoMateriales->save();
    }

    public function getDataModalReqMateriales(Request $request){ 
        $proyectoMateriales = ProyectoMateriales::where('id', $request->item)->first();
        return $proyectoMateriales ;
    }

    public function EditModalReqMateriales(Request $request){
        $proyectoMateriales = ProyectoMateriales::where('id', $request->item)->first();
        $proyectoMateriales->pk_proyecto_reqmateriales = $proyectoMateriales->pk_proyecto_reqmateriales;
        $proyectoMateriales->producto_id =  $proyectoMateriales->producto_id;
        $proyectoMateriales->cantidad = $proyectoMateriales->cantidad;
        $proyectoMateriales->unidmedida_id = $proyectoMateriales->unidmedida_id;
        $proyectoMateriales->cantInfoValor = $request->cCantidadReqmatModal;
        $proyectoMateriales->unidmedidaInfoValor_id = $request->nIdUnidMedOtrosReqModal;
        $proyectoMateriales->fecha = $proyectoMateriales->fecha ;
        $proyectoMateriales->estado = 'R';
        $proyectoMateriales->save();

    }
}
