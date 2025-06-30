<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class InfoServicioExport implements FromView,ShouldAutoSize
{
      use Exportable;
    private $listPInfoServicio = [];
    public function setGenerarExcel($listPInfoServicio)

    {
        $this->listPInfoServicio = $listPInfoServicio;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.InformeServicio', [
            'listPInfoServicio' => $this->listPInfoServicio
        ]);
    }
}
