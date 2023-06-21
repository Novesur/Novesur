<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\InfoProduccionManoObra;
use App\InfoProduccionMaterial;
use App\InfoProduccionOtrosRequerimientos;
use App\InformeProduccion;
use App\ManoObraReqmateriales;
use App\MaterialReqMateriales;
use App\Countable;
use Carbon\Carbon;
use App\OtrosRequerimientosReqMateriales;
use App\Exports\InfoProdDetalleExport;
use App\Exports\InfoProdListExport;
use App\RequerimientosMateriales;
use Illuminate\Http\Request;
use Svg\Tag\Rect;
use PDF; 

class InformeProduccionController extends Controller
{
    public function CargaInfoProduccion(Request $request)
    {
        $data = RequerimientosMateriales::with('cliente')->where('codigo', $request->codRequMateriales)->first();

        return $data;
    }


        public function getListReqMatReqMat(Request $request){

            $CodMaterialReqMateriales = RequerimientosMateriales::where('codigo', $request->codReqMat)->first();
   

                   $data = MaterialReqMateriales::with('producto','producto.marca','producto.familia','producto.material','producto.modelotipo','producto.subfamilia','producto.homologacion','unidmedida')->where('pk_ReqMateriales', $CodMaterialReqMateriales->id)->get();
                  
                   return $data;
        }


        public function getListReqManoObraReqMat(Request $request){

            $idReqMateriales = RequerimientosMateriales::where('codigo', $request->codReqMat)->first();

            $data = ManoObraReqmateriales::where('pk_ReqMateriales',$idReqMateriales->id)->get();
            return $data;


          }

          public function getOtrosRequerimientosReqMateriales(Request $request){
            $idReqMateriales = RequerimientosMateriales::where('codigo', $request->codReqMat)->first();
       
            $dato = OtrosRequerimientosReqMateriales::where('pk_ReqMateriales',$idReqMateriales->id)->get();
            return $dato;
          }



          public function create(Request $request){
            
            $yearMaxID = date("Y");
            $formatreq = date("Y-m-d");
            $countable = Countable::all();
            $countMaxinfoproduccion = $countable[0]->countinfoproduccion;

           // $datos = InformeProduccion::count();


            if($countMaxinfoproduccion == 0){
                $codreqMateriales = 'PROD0001' .'-'. $yearMaxID ;
            }else{
                $maxidinfoProd = InformeProduccion::whereRaw('id = (select max(`id`) from informeproduccion)')->first();
                //$codreqMateriales = 'PROD'. sprintf('%04d',$maxidinfoProd +1).'-'. $yearMaxID;
                $codreqMateriales = 'PROD'. sprintf('%04d',$countMaxinfoproduccion +1).'-'. $yearMaxID;

            }


            $RequerimientosMateriales= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();

            $InfoProduccion = new InformeProduccion();
            $InfoProduccion->codigo = $codreqMateriales;
            $InfoProduccion->producto_id = $RequerimientosMateriales->producto_id;
            $InfoProduccion->cantidad = $request->cCantprod;
            $InfoProduccion->unidmedida_id = $RequerimientosMateriales->unidmedida_id;
            $InfoProduccion->almacen_id = $RequerimientosMateriales->almacen_id;
            $InfoProduccion->cliente_id = $RequerimientosMateriales->cliente_id;
            $InfoProduccion->fecha = $formatreq;
            $InfoProduccion->user_id = $request->nIdUser;
            $InfoProduccion->pk_ReqMateriales = $RequerimientosMateriales->id;
            $InfoProduccion->referencia = $request->cReferencia;
            $InfoProduccion->save();
            Countable::where('id', 1)->update(['countinfoproduccion' => $countMaxinfoproduccion +1]);


           

            $ManoObraReqmateriales = ManoObraReqmateriales::where('pk_ReqMateriales', $RequerimientosMateriales->id)->get();
       
            foreach ($ManoObraReqmateriales as $dataManObraReq) {
  
              $InfoProduccionManoObra = new InfoProduccionManoObra();
              $InfoProduccionManoObra->informeproduccion_id = $InfoProduccion->id;
              $InfoProduccionManoObra->personal = strtoupper($dataManObraReq->personalInfoProd);
              $InfoProduccionManoObra->dias = $dataManObraReq->diasInfoProd;
              $InfoProduccionManoObra->horas = $dataManObraReq->horasInfoProd;
              $InfoProduccionManoObra->costdias = 0;
              $InfoProduccionManoObra->costhoras = 0;
              $InfoProduccionManoObra->total = 0;
              $InfoProduccionManoObra->save();
            }

            $MaterialReqProduccion = MaterialReqMateriales::where('pk_ReqMateriales', $RequerimientosMateriales->id)->get();

            foreach ($MaterialReqProduccion as $dataMatreqProduc) {
                $InfoProduccionMaterial= new InfoProduccionMaterial;
                $InfoProduccionMaterial->informeproduccion_id = $InfoProduccion->id;
                $InfoProduccionMaterial->producto_id = $dataMatreqProduc->producto_id;
                $InfoProduccionMaterial->cantidad = $dataMatreqProduc->cantInfProd;
                $InfoProduccionMaterial->unidmedida_id = $dataMatreqProduc->unidmedida_id;
                $InfoProduccionMaterial->fecha = $dataMatreqProduc->fecha;
                $InfoProduccionMaterial->costunit = 0.00;
                $InfoProduccionMaterial->total = 0.00;
                $InfoProduccionMaterial->save();
            }

            $OtrosRequMateriales = OtrosRequerimientosReqMateriales::where('pk_ReqMateriales', $RequerimientosMateriales->id)->get();
            foreach ($OtrosRequMateriales as $dataOtrosReqMatProduc) {
                $InfoProduccionOtrosRequerimientos = new InfoProduccionOtrosRequerimientos();
                $InfoProduccionOtrosRequerimientos->informeproduccion_id = $InfoProduccion->id;
                $InfoProduccionOtrosRequerimientos->descripcion = strtoupper($dataOtrosReqMatProduc->descripcionInfoProd);
                $InfoProduccionOtrosRequerimientos->cantidad = strtoupper($dataOtrosReqMatProduc->cantidadInfoProd);
                $InfoProduccionOtrosRequerimientos->precio = 0;
                $InfoProduccionOtrosRequerimientos->total = 0;
                $InfoProduccionOtrosRequerimientos->save();
            }

            return response()->json(['message' => 'Informe de Produccion grabada', 'icon' => 'success'], 200);


          }



          public function list(Request $request){
            if (is_null($request->dFecha)  && is_null($request->nIdprod)) {
                $dato = InformeProduccion::with('requerimiento_materiales','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->get();
                return $dato;
            }
            if (is_null($request->dFecha)) {
                $dato = InformeProduccion::with('requerimiento_materiales','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->where('producto_id', $request->nIdprod)->get();
                return $dato;
            }

            if (is_null($request->nIdprod)) {
                $dato = InformeProduccion::with('requerimiento_materiales','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->whereBetween('fecha', [$request->dFecha[0], $request->dFecha[1]])->get();
                return $dato;
            } 
        }
    

    public function saveReqMateriales(Request $request){

        $formatreq = date("Y-m-d");

        $reqMat= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();
        $ordenproduc = InformeProduccion::where('pk_ReqMateriales', $reqMat->id)->first();
        $InfoProduccionMaterial = new InfoProduccionMaterial();
        $InfoProduccionMaterial->informeproduccion_id = $ordenproduc->id;
        $InfoProduccionMaterial->producto_id = $request->nIdmaterial;
        $InfoProduccionMaterial->cantidad = $request->cCantMaterial;
        $InfoProduccionMaterial->unidmedida_id = $request->nIdUnidMedMat;
        $InfoProduccionMaterial->fecha = $formatreq;
        $InfoProduccionMaterial->costunit = 0.00;
        $InfoProduccionMaterial->total = 0.00;
        $InfoProduccionMaterial->save();
    }

    public function saveMObra(Request $request){
    $reqMat= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();
    $ordenproduc = InformeProduccion::where('pk_ReqMateriales', $reqMat->id)->first();
    $InfoProduccionManoObra = new  InfoProduccionManoObra();
    $InfoProduccionManoObra->informeproduccion_id = $ordenproduc->id;
    $InfoProduccionManoObra->personal = strtoupper($request->cPersonal);
    $InfoProduccionManoObra->dias = $request->cDiasMObra;
    $InfoProduccionManoObra->horas = $request->cHorasMObra;
    $ManoObraReqmateriales->costunit = 0;
    $ManoObraReqmateriales->total = 0;
    $InfoProduccionManoObra->save();
    }

    public function saveOtrosRequerimientos(Request $request){
        $reqMat= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();
        $ordenproduc = InformeProduccion::where('pk_ReqMateriales', $reqMat->id)->first();
       $InfoProduccionOtrosRequerimientos = new InfoProduccionOtrosRequerimientos();
       $InfoProduccionOtrosRequerimientos->informeproduccion_id = $ordenproduc->id;
       $InfoProduccionOtrosRequerimientos->descripcion = strtoupper($request->cDescripcion);
       $InfoProduccionOtrosRequerimientos->cantidad = strtoupper($request->cCantidadReq);
       $InfoProduccionOtrosRequerimientos->save();

    }
    public function DeleteReqMateriales(Request $request){
      $InfoProduccionMaterial = InfoProduccionMaterial::where('id',$request->item)->first();
      $InfoProduccionMaterial->delete();
    }

    public function DeleteManodeObra(Request $request){
        $InfoProduccionManoObra = InfoProduccionManoObra::where('id',$request->item)->first();
        $InfoProduccionManoObra->delete();

    }

    public function DeleteOtrosReque(Request $request){
        $InfoProduccionOtrosRequerimientos = InfoProduccionOtrosRequerimientos::where('id',$request->item)->first();
        $InfoProduccionOtrosRequerimientos->delete();
    }

    public function setGenerarInfoProduccionPdf(Request $request)
    {

        $idReqMateriales = $request->get("params")['item'];
        $InfoProduccion = InformeProduccion::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente','requerimiento_materiales')->where('id', $idReqMateriales)->first();
        $InfoProduccionMaterial = InfoProduccionMaterial::with('producto')->where('informeproduccion_id', $idReqMateriales)->get();
        $InfoProduccionManoObra = InfoProduccionManoObra::where('informeproduccion_id', $idReqMateriales)->get();
        $InfoProduccionOtrosRequerimientos = InfoProduccionOtrosRequerimientos::where('informeproduccion_id', $idReqMateriales)->get();
        $logo = asset('img/logo.gif');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.infoProduccion.reporte', [
            'logo' => $logo,
            'InfoProduccion' => $InfoProduccion,
            'InfoProduccionMaterial' => $InfoProduccionMaterial,
            'InfoProduccionManoObra' => $InfoProduccionManoObra,
            'InfoProduccionOtrosRequerimientos' => $InfoProduccionOtrosRequerimientos,

        ]);
        return $pdf->download('invoice.pdf');
    }

    public function EditReqMateriales(Request $request){
        $codReq = RequerimientosMateriales::where('codigo',$request->codRequMateriales)->first();
         $InfoProduccion = InformeProduccion::where('pk_ReqMateriales', $codReq->id)->update(['cantidad' => $request->cCantprod]);
          
    }

    public function addMaterialReqMateriales(Request $request){
        $RequerimientosMateriales = RequerimientosMateriales::where('codigo',$request->codRequMateriales)->first();
        $formatreq = date("Y-m-d");
        $MaterialReqMateriales = new MaterialReqMateriales();
        $MaterialReqMateriales->pk_ReqMateriales = $RequerimientosMateriales->id;
        $MaterialReqMateriales->producto_id = $request->nIdmaterial;
        $MaterialReqMateriales->cantidad = $request->cCantMaterial;
        $MaterialReqMateriales->unidmedida_id = $request->nIdUnidMedMat;
        $MaterialReqMateriales->cantInfProd = $request->cCantMaterial;
        $MaterialReqMateriales->fecha = $formatreq;
        $MaterialReqMateriales->estado = $request->estado;
        $MaterialReqMateriales->save();
    }

    public function addMObra(Request $request){
        $RequerimientosMateriales = RequerimientosMateriales::where('codigo',$request->codRequMateriales)->first();
        $ManoObraReqmateriales = new ManoObraReqmateriales();
        $ManoObraReqmateriales->pk_ReqMateriales = $RequerimientosMateriales->id;
        $ManoObraReqmateriales->personal = strtoupper($request->cPersonal) ;
        $ManoObraReqmateriales->dias = $request->cDiasMObra;
        $ManoObraReqmateriales->horas = $request->cHorasMObra;
        $ManoObraReqmateriales->personalInfoProd = strtoupper($request->cPersonal);
        $ManoObraReqmateriales->diasInfoProd = $request->cDiasMObra;
        $ManoObraReqmateriales->horasInfoProd = $request->cHorasMObra;
        $ManoObraReqmateriales->estado = $request->estado;
   
        $ManoObraReqmateriales->save();
        
    }

    public function addOtrosRequerimientos(Request $request){
        $RequerimientosMateriales = RequerimientosMateriales::where('codigo',$request->codRequMateriales)->first();
        $OtrosRequerimientosReqMateriales = new OtrosRequerimientosReqMateriales();
        $OtrosRequerimientosReqMateriales->pk_ReqMateriales = $RequerimientosMateriales->id;
        $OtrosRequerimientosReqMateriales->descripcion = strtoupper($request->cDescripcion);
        $OtrosRequerimientosReqMateriales->cantidad = $request->cCantidadReq;
        $OtrosRequerimientosReqMateriales->descripcionInfoProd =strtoupper($request->cDescripcion) ;
        $OtrosRequerimientosReqMateriales->cantidadInfoProd = $request->cCantidadReq;
        $OtrosRequerimientosReqMateriales->estado = $request->estado;
        $OtrosRequerimientosReqMateriales->save();
    }

    public function mostrarInfoProd(Request $request){
        $datos = InfoProduccionMaterial::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->where('informeproduccion_id', $request->item)->get();
        return $datos;
    }

    public function mostrarInfoManObra(Request $request){
        
        $datos = InfoProduccionManoObra::where('informeproduccion_id', $request->item)->get();
        return $datos;
    }

    public function mostrarInfOtrosReq(Request $request){
        
        $datos = InfoProduccionOtrosRequerimientos::where('informeproduccion_id', $request->item)->get();
        return $datos;
    }

    public function editPrecioMatOdrProd(Request $request){ 
     
   
       InfoProduccionMaterial::where('id', $request->item)->update(['costunit' => $request->precio, 'total' => $request->total]);
        
    }

    public function  editPrecioHoraOdrProd(Request $request){

         InfoProduccionManoObra::where('id', $request->id)->update(['costhoras' => $request->precioHora, 'total' => $request->total]);
    }

    public function editPrecioDiaOdrProd(Request $request){
        InfoProduccionManoObra::where('id', $request->id)->update(['costdias' => $request->precioDia, 'total' => $request->total]);
    }

    public function editPrecioOtrosReq(Request $request){
     
        InfoProduccionOtrosRequerimientos::where('id', $request->id)->update(['precio' => $request->precioDia, 'total' => $request->total]);
    }

    public function export(Request $request) 
    {
    

        $idReqMateriales = $request->get("params")['item'];
        $diaActual = Carbon::now()->format('d/m/Y');
        $InfoProduccion = InformeProduccion::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente','requerimiento_materiales')->where('id', $idReqMateriales)->first();
        $InfoProduccionMaterial = InfoProduccionMaterial::with('producto')->where('informeproduccion_id', $idReqMateriales)->get();
        $InfoProduccionManoObra = InfoProduccionManoObra::where('informeproduccion_id', $idReqMateriales)->get();
        $InfoProduccionOtrosRequerimientos = InfoProduccionOtrosRequerimientos::where('informeproduccion_id', $idReqMateriales)->get();

        return (new InfoProdDetalleExport)->setGenerarExcel($InfoProduccion, $InfoProduccionMaterial,$InfoProduccionManoObra,  $InfoProduccionOtrosRequerimientos, $diaActual )->download('invoices.xlsx');

    }

    public function ExcelListOrdProd(Request $request){
        $listOrdenProduc = json_decode($request->params['listOrdenProduc']);
        return (new InfoProdListExport)->setGenerarExcel($listOrdenProduc)->download('invoices.xlsx');
    }

}
