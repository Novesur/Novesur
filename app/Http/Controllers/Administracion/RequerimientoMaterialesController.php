<?php

namespace App\Http\Controllers\Administracion;

use App\Cliente;
use App\Http\Controllers\Controller;
use App\ManoObraReqmateriales;
use App\MaterialReqMateriales;
use App\OtrosRequerimientosOrdenProduc;
use App\OtrosRequerimientosReqMateriales;
use App\Producto;
use App\RequerimientoManoObra;
use App\RequerimientosMateriales;
use App\TempMaterialOrdenProd;
use App\TempRequerimientos;
use App\UnidMedida;
use App\Countable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;

class RequerimientoMaterialesController extends Controller
{
    public function create(Request $request)
    {
       

        $yearMaxID = date("Y");
        //$maxidOP = RequerimientosMateriales::whereRaw('id = (select max(`id`) from requerimiento_materiales)')->first();
        $countable = Countable::all();
        $countMaxreqmateriales = $countable[0]->countreqmateriales;
        if ($countMaxreqmateriales == 0) {
            $maxidOP = 'REQ0001'. '-' . $yearMaxID;
        } else {

            $maxidOP = 'REQ' . sprintf('%04d', $countMaxreqmateriales + 1) . '-' . $yearMaxID;
        }

        $codclient = Cliente::where('ruc', $request->cRuc)->first();
        $formatreq = date("Y-m-d");

        if ($codclient) {
            $idclient = $codclient->id;
        } else {
            $idclient = '202';
        }
        $dateIni = Carbon::parse($request->FInicio)->format('Y-m-d');
        $dateFinal = Carbon::parse($request->FFinal)->format('Y-m-d');

        $requerimientoMateriales = new RequerimientosMateriales();
        $requerimientoMateriales->producto_id = $request->nIdproduct;
        $requerimientoMateriales->codigo = $maxidOP;
        $requerimientoMateriales->cantidad = $request->cCantprod;
        $requerimientoMateriales->unidmedida_id = $request->nIdUnidMed;
        if ($request->nidAlmacen == NULL) {
            $requerimientoMateriales->almacen_id = 6;
        } else {
            $requerimientoMateriales->almacen_id = $request->nidAlmacen;
        }
        
        $requerimientoMateriales->cliente_id = $idclient;
        $requerimientoMateriales->fecha = $formatreq;
        $requerimientoMateriales->fechainicio = $dateIni;
        $requerimientoMateriales->fechafinal = $dateFinal;
        $requerimientoMateriales->duracion = $request->Duracionfechas;
        $requerimientoMateriales->user_id = $request->nIdUser;
        $requerimientoMateriales->cantInfoProd = $request->cCantprod;
        $requerimientoMateriales->referencia = $request->cReferencia;
        $requerimientoMateriales->save();

        Countable::where('id', 1)->update(['countreqmateriales' => $countMaxreqmateriales +1 ]);
      
        $MaterialOrdenProd = Session::get('materialReqMatprod');
        $allMaterialreqMat = $MaterialOrdenProd->map(function ($MaterialOP) use ($requerimientoMateriales) {
            $formatreq = date("Y-m-d");
            return [
                'pk_ReqMateriales' => $requerimientoMateriales->id,
                'producto_id' => $MaterialOP->producto_id,
                'cantidad' => $MaterialOP->cantidad,
                'unidmedida_id' =>  $MaterialOP->unidMedida_id,
                'cantInfProd'  => $MaterialOP->cantidad,
                'fecha' =>  $formatreq,
                'estado'=> $MaterialOP->estado
            ];
        });
        MaterialReqMateriales::insert($allMaterialreqMat->toArray());
        DB::commit();
        Session::put('materialReqMatprod', collect([]));



        $RequerimientoManoObra = Session::get('MaterialReqMObra');
        $allRequerimientoObra = $RequerimientoManoObra->map(function ($ReqManoObra) use ($requerimientoMateriales) {
            return [
                'pk_ReqMateriales' => $requerimientoMateriales->id,
                'personal' => $ReqManoObra->personal,
                'dias' =>  $ReqManoObra->dias,
                'horas' => $ReqManoObra->horas,
                'personalInfoProd' => $ReqManoObra->personal,
                'diasInfoProd' => $ReqManoObra->dias,
                'horasInfoProd' => $ReqManoObra->horas,
                'estado'=> $ReqManoObra->estado

            ];
        });
        ManoObraReqmateriales::insert($allRequerimientoObra->toArray());
        DB::commit();
        Session::put('MaterialReqMObra', collect([]));



        $OtrosRequerimientos = Session::get('OtrosReqMateriales');
        $allOtrosReque =  $OtrosRequerimientos->map(function ($otrosReque) use ($requerimientoMateriales) {
            return [
                'pk_ReqMateriales' => $requerimientoMateriales->id,
                'descripcion' => $otrosReque->descripcion,
                'cantidad' => $otrosReque->cantidad,
                'descripcionInfoProd' => $otrosReque->descripcion,
                'cantidadInfoProd' => $otrosReque->cantidad,
                'estado'=> $otrosReque->estado
            ];
        });
        OtrosRequerimientosReqMateriales::insert($allOtrosReque->toArray());
        DB::commit();
        Session::put('OtrosReqMateriales', collect([]));


        return response()->json(['message' => 'Nuevo Requerimiento Materiales agregado', 'icon' => 'success'], 200);
    }

    public function addOrden(Request $request)
    {
       
        $product = Producto::where(['id' => $request->nIdmaterial])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('materialReqMatprod');
        $products = ($products != null) ? collect($products) : collect([]);

        $unidMedida = UnidMedida::where('id', $request->nIdUnidMedMat)->first();

        if($request->cCantMaterial == 0){
            return response()->json([ 'message' => 'El valor no puede ser cero', 'icon' => 'error'], 200);
        }
   

        $exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $tempOrder = new TempMaterialOrdenProd();
            $tempOrder->fill(['cantidad' => $request->cCantMaterial,  'codigo' => $product->codigo, 'producto_id' => $request->nIdmaterial,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre, 'unidMedida' => $unidMedida->nombre, 'unidMedida_id' => $unidMedida->id,'estado' => $request->estado]);
            $products->push($tempOrder);
            Session::put('materialReqMatprod', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);
        endif;
    }

    public  function eliminarTemporder()
    {
        Session::put('materialReqMatprod', null);
        $dato = session()->get('materialReqMatprod') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function addMObra(Request $request)
    {
        $materiales = Session::get('MaterialReqMObra');
        $materiales = ($materiales != null) ? collect($materiales) : collect([]);
        $tempMatOrdenMaterial = new TempMaterialOrdenProd();
        $tempMatOrdenMaterial->fill(['personal' => mb_strtoupper($request->cPersonal), 'dias' => $request->cDiasMObra, 'horas' => $request->cHorasMObra,'estado' => $request->estado ]);
        $materiales->push($tempMatOrdenMaterial);
        Session::put('MaterialReqMObra', $materiales);
        return response()->json(['datos' => $materiales, 'message' => NULL]);
    }



    public function CleanMaterialReqMObra()
    {
        Session::put('MaterialReqMObra', null); 
        $dato = session()->get('MaterialReqMObra') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function addRequerimientos(Request $request)
    {
        $requerimientos = Session::get('OtrosReqMateriales');
        $requerimientos = ($requerimientos != null) ? collect($requerimientos) : collect([]);
        if($request->cCantidadReq == 0 || null ){
            return response()->json(['message' => 'El valor no puede ser cero ni vacio', 'icon' => 'error'], 200);
        }
        $tempRequerimientos = new TempRequerimientos();
        $tempRequerimientos->fill(['descripcion' => mb_strtoupper($request->cDescripcion), 'cantidad' => mb_strtoupper($request->cCantidadReq),'estado'=> $request->estado]);
        $requerimientos->push($tempRequerimientos);
        Session::put('OtrosReqMateriales', $requerimientos);
        return response()->json(['datos' => $requerimientos, 'message' => NULL]);
    }

    public function CleanRequerimientos()
    {
        Session::put('OtrosReqMateriales', null); 
        $dato = session()->get('OtrosReqMateriales') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function List(Request $request)
    {

        if (is_null($request->dFecha)  && is_null($request->nIdprod)) {
            $dato = RequerimientosMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->get();
            return $dato;
        }
        if (is_null($request->dFecha)) {
            $dato = RequerimientosMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->where('producto_id', $request->nIdprod)->get();
            return $dato;
        }

        if (is_null($request->nIdprod)) {
            $dato = RequerimientosMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->whereBetween('fecha', [$request->dFecha[0],$request->dFecha[1]])->get();
            return $dato;
        }
    }

    public function setGenerarOrderPrduccionPdf(Request $request)
    {

        $idReqMateriales = $request->get("params")['idReqMatProduc'];
        $RequerimientosMateriales = RequerimientosMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->where('id', $idReqMateriales)->first();
        
        $MaterialReqMateriales = MaterialReqMateriales::with('producto','producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
        ->where(
            ['pk_ReqMateriales' => $idReqMateriales],
            ['estado' => 'R'])
       ->get();
      
       
      
        $ManoObraReqmateriales = ManoObraReqmateriales::where('pk_ReqMateriales', $idReqMateriales)->where('estado', 'R')->get();
        $OtrosRequerimientosReqMateriales = OtrosRequerimientosReqMateriales::where('pk_ReqMateriales', $idReqMateriales)->where('estado', 'R')->get();
        $logo = asset('img/logo.gif');


        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.reqmateriales.requerimientoMaterialespdf', [
            'logo' => $logo,
            'RequerimientosMateriales' => $RequerimientosMateriales,
            'MaterialReqMateriales' => $MaterialReqMateriales,
            'ManoObraReqmateriales' => $ManoObraReqmateriales,
            'OtrosRequerimientosReqMateriales' => $OtrosRequerimientosReqMateriales,
        ]);
        return $pdf->download('invoice.pdf');
    }


    public function reorderReqMateriales(Request $request)
    {

        $id = (int)trim($request->item);
        $items = session()->get('materialReqMatprod') ?? collect([]);
        $exits = $items->firstWhere("producto_id", $id);
      
        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto_id", [$id]);
            session()->put('materialReqMatprod', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public function reorderReqManObra(Request $request){
        $id = trim($request->item);
        $items = session()->get('MaterialReqMObra') ?? collect([]);
        $exits = $items->firstWhere("personal", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("personal", [$id]);
            session()->put('MaterialReqMObra', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);

    }

    public function reorderOtrosReq(Request $request){
        $id = trim($request->item);
        $items = session()->get('OtrosReqMateriales') ?? collect([]);
        $exits = $items->firstWhere("descripcion", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("descripcion", [$id]);
            session()->put('OtrosReqMateriales', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);

    }
    public function getDataReqMateriales(Request $request){
        $dato = MaterialReqMateriales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')->where('id', $request->item)->first();
        return $dato;
    }

    public function EditModalReqMateriales(Request $request){
        
        $MaterialReqMateriales = MaterialReqMateriales::find($request->item);
        if($MaterialReqMateriales) {
            $MaterialReqMateriales->cantInfProd = $request->cCantprodEdit;
            $MaterialReqMateriales->unidmedida_id = $request->nIdUnidMedEdit;
            $MaterialReqMateriales->save();
        }
    }
    public function getDataReqManoObra(Request $request){
        $dato = ManoObraReqmateriales::where('id', $request->item)->first();
        return $dato;
    }

    public function EditModalManoObra(Request $request){
        
         $ManoObraReqmateriales = ManoObraReqmateriales::find($request->item);
        
         if($ManoObraReqmateriales) {
             $ManoObraReqmateriales->personalInfoProd = strtoupper($request->cPersonalModal);
             $ManoObraReqmateriales->diasInfoProd = $request->cDiasMObraModal;
             $ManoObraReqmateriales->horasInfoProd = $request->cHorasMObraModal;
             $ManoObraReqmateriales->save();
         }
     }

     public function getDataOtrosReq(Request $request){
        $dato = OtrosRequerimientosReqMateriales::where('id', $request->item)->first();
        return $dato;
     }

     public function EditModalOtrosReq(Request $request){
        $OtrosRequerimientosReqMateriales = OtrosRequerimientosReqMateriales::find($request->item);
       
        if($OtrosRequerimientosReqMateriales) {
            $OtrosRequerimientosReqMateriales->descripcionInfoProd = strtoupper($request->cDescripModal);
            $OtrosRequerimientosReqMateriales->cantidadInfoProd = $request->cCantidadModal;
            $OtrosRequerimientosReqMateriales->save();
        }
     }


    
}
