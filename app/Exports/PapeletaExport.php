<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PapeletaExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $dato = [];

    public function setGenerarExcel($dato)

    {
        $this->dato = $dato;

        return  $this;
    }

    public function view(): View
    {
        return view('excel.PapeletaSalida', [
            'dato' => $this->dato
        ]);
    }
}
