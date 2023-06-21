<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteTotalExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listeMenuDetalleTotalFecha = [];
    public function setGenerarExcel($listeMenuDetalleTotalFecha)

    {
        $this->listeMenuDetalleTotalFecha = $listeMenuDetalleTotalFecha;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.DetalleMenuTotal', [
            'listeMenuDetalleTotalFecha' => $this->listeMenuDetalleTotalFecha
        ]);
    }
}
