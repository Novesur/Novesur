<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReporteVentasFechaEstadoExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listPaginacion = [];
    public function setGenerarExcel($listPaginacion)

    {
        $this->listPaginacion = $listPaginacion;

        return  $this;


    }

    public function view(): View
    {
        return view('excel.ReporteVentasFechaEstado', [
            'ReporteVentasFechaEstado' => $this->listPaginacion
        ]);
    }
}

