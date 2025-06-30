<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class InfoValorServicioExport implements FromView,ShouldAutoSize,WithColumnWidths

{

      public function columnWidths(): array
    {
        return [
            'A' => 55,
            'B' => 130,
            'C' => 35,
            'D' => 10,
            'E' => 10,
            'F' => 10,
        ];
    }

   use Exportable;
    private $servicioInforme = [];
    private $servicioInforme_Materiales = [];
    private $servicioInforme_ManObra = [];
    private $servicioInforme_OtrosRequerimientos = [];

  public function setGenerarExcel($servicioInforme, $servicioInforme_Materiales,$servicioInforme_ManObra,$servicioInforme_OtrosRequerimientos, $diaActual)
    {
        $this->servicioInforme = $servicioInforme;
        $this->servicioInforme_Materiales = $servicioInforme_Materiales;
        $this->servicioInforme_ManObra = $servicioInforme_ManObra;
        $this->servicioInforme_OtrosRequerimientos = $servicioInforme_OtrosRequerimientos;
        $this->diaActual = $diaActual;
       // dd($diaActual);
        return  $this;
    }

    public function view(): View
    {
        return view('excel.InfoServicioDetalle', [
            'servicioInforme' => $this->servicioInforme,
            'servicioInforme_Materiales' => $this->servicioInforme_Materiales,
            'servicioInforme_ManObra' => $this->servicioInforme_ManObra,
            'servicioInforme_OtrosRequerimientos' => $this->servicioInforme_OtrosRequerimientos,
            'diaActual'  => $this->diaActual,
        ]);
    }
}
