<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DetalleMenuExport implements FromView,ShouldAutoSize
{
    use Exportable;

    private $listeMenuDetallexFecha = [];
    public function setGenerarExcel($listeMenuDetallexFecha)

    {
        $this->listeMenuDetallexFecha = $listeMenuDetallexFecha;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.DetalleMenu', [
            'DetalleMenu' => $this->listeMenuDetallexFecha
        ]);
    }
}
