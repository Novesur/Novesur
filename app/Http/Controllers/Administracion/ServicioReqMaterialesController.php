<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\MaterialServicio;
use App\Servicio;
use App\ServicioInforme;
use App\Countable;
use App\ServicioInforme_Materiales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ServicioReqMaterialesController extends Controller
{
    public function listbyId(Request $request)
    {

        $yearMaxID = date("Y");

        $countable = Countable::all();
        $countMaxServicio = $countable[0]->countInfoServicio;

        if ($countMaxServicio == 0) {
            $maxidOS = 'SC0001' . '-' . $yearMaxID;
        } else {

            $maxidOS = 'SC' . sprintf('%04d', $countMaxServicio + 1) . '-' . $yearMaxID;
        }

        $dato = Servicio::where('codigo', $request->codRequMateriales)->first();

        $datoServicio = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();
        $validaServicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->get();

        if ($validaServicioInforme->count() == 0) {
            //Guardamos el informe de Servicio
            $yearMaxID = date("Y");
            $countable = Countable::all();
            $countMaxInformeServicio = $countable[0]->countInfoServicio;
            if ($countMaxInformeServicio == 0) {
                $maxidPReqMat = 'SERVAL0001' . '-' . $yearMaxID;
            } else {

                $maxidPReqMat = 'SERVAL' . sprintf('%04d', $countMaxInformeServicio + 1) . '-' . $yearMaxID;
            }
            $ProyectoServicio = Servicio::where('codigo', $request->codRequMateriales)->first();

            $InformeServicio = new ServicioInforme();
            $InformeServicio->codigo = $maxidPReqMat;
            $InformeServicio->fecha = $ProyectoServicio->fecha;
            $InformeServicio->cliente = $ProyectoServicio->cliente;
            $InformeServicio->detservicio = mb_strtoupper($ProyectoServicio->detservicio);
             $InformeServicio->cantidad = $ProyectoServicio->cantidad;
            $InformeServicio->fechainicio = $ProyectoServicio->fechainicio;
            $InformeServicio->fechafinal = $ProyectoServicio->fechafinal;
            $InformeServicio->duracion = $ProyectoServicio->duracion;
            $InformeServicio->ord_servicio = $request->codRequMateriales;
            $InformeServicio->user_id = $request->nIdUser;
            $InformeServicio->save();

            Countable::where('id', 1)->update(['countInfoServicio' => $countMaxServicio + 1]);

            ///Fin del Guardado
        }
    //ServicioInforme::where('ord_servicio', $request->codRequMateriales)->update(['cantidad' => $dato->cantidad]);

        return $datoServicio;
    }



    public function listproyMateriales(Request $request)
    {
        $dato = Servicio::where('codigo', $request->codRequMateriales)->first();
        $materialServicio = MaterialServicio::where('pk_Servicios', $dato->id)->first();
        $validaServicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();
        $countSerInfoMateriales = ServicioInforme_Materiales::where('pk_servicio_informe',$validaServicioInforme->id)->get();



      if ($countSerInfoMateriales->count() == 0) {
              $formatreq = date("Y-m-d");
              $servicioInformeMateriales = new ServicioInforme_Materiales();
              $servicioInformeMateriales->pk_servicio_informe= $validaServicioInforme->id;
              $servicioInformeMateriales->producto_id= $materialServicio->producto_id;
              $servicioInformeMateriales->cantidad= $materialServicio->cantidad;
              $servicioInformeMateriales->unidmedida_id= $materialServicio->unidmedida_id;
              $servicioInformeMateriales->fecha= $formatreq;
              $servicioInformeMateriales->costunit= 0;
              $servicioInformeMateriales->total= 0;
              $servicioInformeMateriales->save();
         }
        $dato = ServicioInforme_Materiales::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->where('pk_servicio_informe', $validaServicioInforme->id)->get();
        return $dato;
    }

    public function addReqMatServicio(Request $request)
    {
        $formatreq = date("Y-m-d");
        $servicio = Servicio::where('codigo', $request->codRequMateriales)->first();
        $servicioMateriales = new ServicioInforme_Materiales();
        $validaServicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();
        $servicioMateriales->pk_servicio_informe = $validaServicioInforme->id;
        $servicioMateriales->producto_id = $request->nIdmaterial;
        $servicioMateriales->cantidad = $request->cCantMaterial;
        $servicioMateriales->unidmedida_id = $request->nIdUnidMedMat;
        $servicioMateriales->fecha = $formatreq;
        $servicioMateriales->costunit= 0;
        $servicioMateriales->total= 0;
        $servicioMateriales->save();
    }

    public function reorderReqMateriales(Request $request)
    {

        $materialServicio = ServicioInforme_Materiales::where('id', $request->item)->first();
        $materialServicio->delete();
    }

    public function getDataModalReqMateriales(Request $request)
    {
        $materialServicio = ServicioInforme_Materiales::where('id', $request->item)->first();
        return $materialServicio;
    }


    public function EditModalReqMateriales(Request $request)
    {

        $formatreq = date("Y-m-d");
        $materialServicio = ServicioInforme_Materiales::where('id', $request->item)->first();
        $materialServicio->pk_servicio_informe = $materialServicio->pk_servicio_informe;
        $materialServicio->producto_id =  $materialServicio->producto_id;
        $materialServicio->cantidad = $request->cCantidadReqmatModal;
        $materialServicio->unidmedida_id = $request->nIdUnidMedOtrosReqModal;
        $materialServicio->fecha = $materialServicio->fecha;
         $materialServicio->fecha = $formatreq;
        $materialServicio->costunit= 0;
        $materialServicio->total= 0;
        $materialServicio->save();
    }

    public function list(Request $request)
    {
        if (is_null($request->dFecha)  && is_null($request->nIdprod)) {
            $dato = MaterialServicio::with('servicio', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->get();
            return $dato;
        }
        if (is_null($request->dFecha)) {
            $dato = MaterialServicio::with('servicio', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->where('producto_id', $request->nIdprod)->get();
            return $dato;
        }

        if (is_null($request->nIdprod)) {
            $dato = MaterialServicio::with('servicio', 'producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida')->whereBetween('fecha', [$request->dFecha[0], $request->dFecha[1]])->get();
            return $dato;
        }
    }



}
