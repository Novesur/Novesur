<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;



class InfoProdDetalleExport implements  FromView,ShouldAutoSize,WithColumnWidths
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
    private $InfoProduccion = [];
    private $InfoProduccionMaterial = [];
    private $InfoProduccionManoObra = [];
    private $InfoProduccionOtrosRequerimientos = [];

   
    public function setGenerarExcel($InfoProduccion, $InfoProduccionMaterial,$InfoProduccionManoObra,$InfoProduccionOtrosRequerimientos, $diaActual)
    {
        $this->InfoProduccion = $InfoProduccion;
        $this->InfoProduccionMaterial = $InfoProduccionMaterial;
        $this->InfoProduccionManoObra = $InfoProduccionManoObra;
        $this->InfoProduccionOtrosRequerimientos = $InfoProduccionOtrosRequerimientos;
        $this->diaActual = $diaActual;
       // dd($diaActual);
        return  $this;
    }

    public function view(): View
    {
        return view('excel.OrdenProduccion', [
            'InfoProduccion' => $this->InfoProduccion,
            'InfoProduccionMaterial' => $this->InfoProduccionMaterial,
            'InfoProduccionManoObra' => $this->InfoProduccionManoObra,
            'InfoProduccionOtrosRequerimientos' => $this->InfoProduccionOtrosRequerimientos,
            'diaActual'  => $this->diaActual,
        ]);
    }
}
