<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Servicio;
use App\Countable;
use App\MaterialServicio;
use App\ManObraServicio;
use App\TempservicioMateriales;
use App\TempServicioManObra;
use App\TempServiciOtrosRequerimientos;
use App\OtrosRequerimientosServicio;
use App\Producto;
use App\UnidMedida;
use App\Personal;
use PDF;




class ServicioController extends Controller
{
    public function create(Request $request)
    {

        $yearMaxID = date("Y");

        $countable = Countable::all();
        $countMaxServicio = $countable[0]->countServicio;

        if ($countMaxServicio == 0) {
            $maxidOS = 'SC0001' . '-' . $yearMaxID;
        } else {

            $maxidOS = 'SC' . sprintf('%04d', $countMaxServicio + 1) . '-' . $yearMaxID;
        }


        $dateIni = Carbon::parse($request->FInicio)->format('Y-m-d');
        $dateFinal = Carbon::parse($request->FFinal)->format('Y-m-d');
        $formatreq = date("Y-m-d");

        $servicio = new Servicio();
        $servicio->codigo = $maxidOS;
        $servicio->fecha = $formatreq;
        $servicio->cliente = $request->cClient;
        $servicio->ruc_dni = $request->cRuc;
        $servicio->detservicio = mb_strtoupper($request->detservicio);
        $servicio->cantidad = $request->cCantidad;
        $servicio->fechainicio = $dateIni;
        $servicio->fechafinal = $dateFinal;
        $servicio->duracion = $request->Duracionfechas;
        $servicio->user_id = $request->nIdUser;
        $servicio->save();

        Countable::where('id', 1)->update(['countServicio' => $countMaxServicio + 1]);


        $MaterialOrdenProd = Session::get('servicioMaterial');
        $allMaterialreqMat = $MaterialOrdenProd->map(function ($MaterialOP) use ($servicio) {
            $formatreq = date("Y-m-d");
            return [
                'pk_Servicios' => $servicio->id,
                'producto_id' => $MaterialOP->producto_id,
                'cantidad' => $MaterialOP->cantidad,
                'unidmedida_id' =>  $MaterialOP->unidMedida_id,
                'cantServicio'  => $MaterialOP->cantidad,
                'unidmedidaInfoValor_id' =>  $MaterialOP->unidMedida_id,
                'fecha' =>  $formatreq,
                'estado' => $MaterialOP->estado
            ];
        });
        MaterialServicio::insert($allMaterialreqMat->toArray());
        DB::commit();
        Session::put('servicioMaterial', collect([]));



        $RequerimientoManoObra = Session::get('MaterialReqMObra');

        $allRequerimientoObra = $RequerimientoManoObra->map(function ($ReqManoObra) use ($servicio) {
            return [
                'pk_Servicios' => $servicio->id,
                'personal' => $ReqManoObra->personal_nombres . ' ' . $ReqManoObra->personal_paterno . ' ' . $ReqManoObra->personal_materno,
                'dias' =>  $ReqManoObra->dias,
                'horas' => $ReqManoObra->horas,
                'personalServicio' => $ReqManoObra->personal_nombres . ' ' . $ReqManoObra->personal_paterno . ' ' . $ReqManoObra->personal_materno,
                'diasServicio' => $ReqManoObra->dias,
                'horasServicio' => $ReqManoObra->horas,
                'estado' => $ReqManoObra->estado

            ];
        });
        ManObraServicio::insert($allRequerimientoObra->toArray());
        DB::commit();
        Session::put('MaterialReqMObra', collect([]));



        $OtrosRequerimientos = Session::get('OtrosReqMateriales');
        $allOtrosReque =  $OtrosRequerimientos->map(function ($otrosReque) use ($servicio) {
            return [
                'pk_Servicios' => $servicio->id,
                'descripcion' => $otrosReque->descripcion,
                'cantidad' => $otrosReque->cantidad,
                'unidmedida_id' => $otrosReque->nIdUnidmed,
                'descripcionServicio' => $otrosReque->descripcion,
                'cantidadServicio' => $otrosReque->cantidad,
                'unidmedida_idInfoValor' => $otrosReque->nIdUnidmed,
                'estado' => $otrosReque->estado
            ];
        });
        OtrosRequerimientosServicio::insert($allOtrosReque->toArray());
        DB::commit();
        Session::put('OtrosReqMateriales', collect([]));


        return response()->json(['message' => 'Nuevo Requerimiento Materiales agregado', 'icon' => 'success'], 200);
    }




    public function addOrden(Request $request)
    {

        $product = Producto::where(['id' => $request->nIdmaterial])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('servicioMaterial');
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
            $tempOrder = new TempservicioMateriales();
            $tempOrder->fill(['cantidad' => $request->cCantMaterial,  'codigo' => $product->codigo, 'producto_id' => $request->nIdmaterial,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre, 'unidMedida' => $unidMedida->nombre, 'unidMedida_id' => $unidMedida->id, 'estado' => $request->estado]);
            $products->push($tempOrder);
            Session::put('servicioMaterial', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);
        endif;
    }

    public function reorderServicio(Request $request)
    {

        $id = (int)trim($request->item);
        $items = session()->get('servicioMaterial') ?? collect([]);
        $exits = $items->firstWhere("producto_id", $id);

        if (!empty($exits)) :
            $items =  $items->whereNotIn("producto_id", [$id]);
            session()->put('servicioMaterial', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public function addServManObra(Request $request)
    {
        $personal = Personal::where('id', $request->nIdPersonal)->first();
        $materiales = Session::get('MaterialReqMObra');
        $materiales = ($materiales != null) ? collect($materiales) : collect([]);
        $tempMatOrdenMaterial = new TempServicioManObra();
        $tempMatOrdenMaterial->fill(['id_personal' => $personal->id, 'personal_nombres' => mb_strtoupper($personal->nombres), 'personal_paterno' => mb_strtoupper($personal->ApPaterno), 'personal_materno' => mb_strtoupper($personal->ApMaterno), 'dias' => $request->cDiasMObra, 'horas' => $request->cHorasMObra, 'estado' => $request->estado]);
        $materiales->push($tempMatOrdenMaterial);
        Session::put('MaterialReqMObra', $materiales);
        return response()->json(['datos' => $materiales, 'message' => NULL]);
    }


    public function addOtrosServicios(Request $request)
    {
        $Unidmed = UnidMedida::where('id', $request->nIdUnidMedOtroReq)->first();
        $requerimientos = Session::get('OtrosReqMateriales');
        $requerimientos = ($requerimientos != null) ? collect($requerimientos) : collect([]);
        /*    if($request->cCantidadReq == 0 || null ){
            return response()->json(['message' => 'El valor no puede ser cero ni vacio', 'icon' => 'error'], 200);
        } */
        $tempRequerimientos = new TempServiciOtrosRequerimientos();
        $tempRequerimientos->fill(['descripcion' => mb_strtoupper($request->cDescripcion), 'cantidad' => mb_strtoupper($request->cCantidadReq), 'estado' => $request->estado, 'cCantAlq' => $request->cCantAlq, 'cPrecioReq' => $request->cPrecioReq, 'nIdUnidmed' => $request->nIdUnidMedOtroReq, 'NomUnidmed' => $Unidmed->nombre]);
        $requerimientos->push($tempRequerimientos);
        Session::put('OtrosReqMateriales', $requerimientos);
        return response()->json(['datos' => $requerimientos, 'message' => NULL]);
    }

    public function reorderServicioManObra(Request $request)
    {
        $id = trim($request->item);
        $items = session()->get('MaterialReqMObra') ?? collect([]);
        $exits = $items->firstWhere("id_personal", $id);

        if (!empty($exits)) :
            $items =  $items->whereNotIn("id_personal", [$id]);
            session()->put('MaterialReqMObra', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }


    public function reorderOtrosReq(Request $request)
    {
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



    public function setGenerarServicioPdf(Request $request)
    {



        $idReqMateriales = $request->get("params")['idReqMatProduc'];
        $servicio = MaterialServicio::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')
            ->where('id', $idReqMateriales)->first();

        // dd($servicio->pk_Servicios);


        $materialServicio = MaterialServicio::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion')
            ->where(
                ['pk_Servicios' => $servicio->pk_Servicios],
                ['estado' => 'R']
            )
            ->get();

        $ManoObraReqmateriales = ManObraServicio::where('pk_Servicios', $servicio->pk_Servicios)->where('estado', 'S')->get();


        $OtrosRequerimientosReqMateriales = OtrosRequerimientosServicio::where('pk_Servicios', $servicio->pk_Servicios)->where('estado', 'S')->get();
        $logo = asset('img/logo.gif');

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.servicio.reporte', [
            'logo' => $logo,
            'servicio' => $servicio,
            'materialServicio' => $materialServicio,
            'ManoObraReqmateriales' => $ManoObraReqmateriales,
            'OtrosRequerimientosReqMateriales' => $OtrosRequerimientosReqMateriales,
        ]);
        return $pdf->download('invoice.pdf');
    }


    public function list(Request $request)
    {
        if (is_null($request->dFecha)  && is_null($request->nIdprod)) {
            $dato = MaterialServicio::with('servicio', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->get();
            return $dato;
        }
        if (is_null($request->dFecha)) {
            $dato = MaterialServicio::with('servicio', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->where('producto_id', $request->nIdprod)->get();
            return $dato;
        }

        if (is_null($request->nIdprod)) {
            $dato = MaterialServicio::with('servicio', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->whereBetween('fecha', [$request->dFecha[0], $request->dFecha[1]])->get();
            return $dato;
        }
    }

    public function servicioById(Request $request)
    {


        $dato = Servicio::where('id', $request->nIdServicio)->first();
        return $dato;
    }
}
