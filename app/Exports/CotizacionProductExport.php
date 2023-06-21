<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CotizacionProductExport  implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listCotizacion = [];
    public function setGenerarExcel($listCotizacion, $producto)

    {
        $this->listCotizacion = $listCotizacion;
        $this->producto = $producto;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.CotizacionProduct', [
            'listCotizacion' => $this->listCotizacion, 'producto' => $this->producto,

        ]);
    }
}
