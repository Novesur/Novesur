<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class InfoValorDetalleExport implements  FromView,ShouldAutoSize,WithColumnWidths
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
    private $InformeValorizacion = [];
    private $valorizacionReqMateriales = [];
    private $valorizacionManoObra = [];
    private $valorizacionOtrosReq = [];

   
    public function setGenerarExcel($InformeValorizacion, $valorizacionReqMateriales,$valorizacionManoObra,$valorizacionOtrosReq, $diaActual)
    {
        $this->InformeValorizacion = $InformeValorizacion;
        $this->valorizacionReqMateriales = $valorizacionReqMateriales;
        $this->valorizacionManoObra = $valorizacionManoObra;
        $this->valorizacionOtrosReq = $valorizacionOtrosReq;
        $this->diaActual = $diaActual;
       // dd($diaActual);
        return  $this;
    }

    public function view(): View
    {
        return view('excel.InfoValorizacion', [ 
            'InformeValorizacion' => $this->InformeValorizacion,
            'valorizacionReqMateriales' => $this->valorizacionReqMateriales,
            'valorizacionManoObra' => $this->valorizacionManoObra,
            'valorizacionOtrosReq' => $this->valorizacionOtrosReq,
            'diaActual'  => $this->diaActual,
        ]);
    }
}
