<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\ManObraServicio;
use App\Personal;
use App\Servicio;
use App\ServicioInforme;
use App\ServicioInforme_ManObra;
use Illuminate\Http\Request;

class ServicioManoObraController extends Controller
{
    public function listproyManoObra(Request $request)
    {
        $servicio = Servicio::where('codigo', $request->codRequMateriales)->first();
        $manoObraServicio = ManObraServicio::where('pk_Servicios', $servicio->id)->first();

        $validaServicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();
        $countSerInfoManoObra = ServicioInforme_ManObra::where('pk_servicio_informe', $validaServicioInforme->id)->get();
        if ($countSerInfoManoObra->count() == 0) {
            $servicioManObraServicio = new ServicioInforme_ManObra();
            $servicioManObraServicio->pk_servicio_informe = $manoObraServicio->id;
            $servicioManObraServicio->personal = $manoObraServicio->personalServicio;
            $servicioManObraServicio->dias = $manoObraServicio->diasServicio;
            $servicioManObraServicio->horas = $manoObraServicio->horasServicio;
            $servicioManObraServicio->costdias = 0;
            $servicioManObraServicio->costhoras = 0;
            $servicioManObraServicio->total = 0;

            $servicioManObraServicio->save();
        }

        $dato = ServicioInforme_ManObra::where('pk_servicio_informe', $validaServicioInforme->id)->get();
        return $dato;
    }

    public function addReqMatProyManObra(Request $request)
    {


        $validaServicioInforme = ServicioInforme::where('ord_servicio', $request->codRequMateriales)->first();

        $personal = Personal::where('id', $request->nIdPersonal)->first();
        $manObraServicio = new ServicioInforme_ManObra();
        $manObraServicio->pk_servicio_informe = $validaServicioInforme->id;
        $manObraServicio->personal = $personal->nombres . ' ' . $personal->nombresApPaterno . ' ' . $personal->ApMaterno;
        $manObraServicio->dias = $request->cDiasMObra;
        $manObraServicio->horas = $request->cHorasMObra;
        $manObraServicio->personalInfoValor = $personal->nombres . ' ' . $personal->nombresApPaterno . ' ' . $personal->ApMaterno;
        $manObraServicio->diasInfoValor = $request->cDiasMObra;
        $manObraServicio->horasInfoValor = $request->cHorasMObra;
        $manObraServicio->estado = $request->estado;
        $manObraServicio->save();
    }

    public function reorderReqManObra(Request $request)
    {

        $servicioManObra = ServicioInforme_ManObra::where('id', $request->item)->first();
        $servicioManObra->delete();
    }


    public function ListValorMaNObraxInfoValor(Request $request)
    {
        $servicioInforme = ServicioInforme::where('id', $request->pk_Servicios)->first();
        $dato = ServicioInforme_ManObra::where('pk_servicio_informe', $servicioInforme->id)->get();
        return $dato;
    }

        public function mostrarInfoManObra(Request $request)
    {
        $datos = ServicioInforme_ManObra::where('pk_servicio_informe', $request->item)->get();
        return $datos;
    }
}
