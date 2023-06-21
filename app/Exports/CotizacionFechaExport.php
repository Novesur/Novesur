<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CotizacionFechaExport  implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listCotizacionByDate = [];
    public function setGenerarExcel($listCotizacionByDate)

    {
        $this->listCotizacionByDate = $listCotizacionByDate;

        return  $this;
    }

    public function view(): View
    {
        return view('excel.CotizacionFecha', [
            'listCotizacionByDate' => $this->listCotizacionByDate,

        ]);
    }
}
