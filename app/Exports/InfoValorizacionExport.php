<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class InfoValorizacionExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listPInfoValorizacion = [];
    public function setGenerarExcel($listPInfoValorizacion)

    {
        $this->listPInfoValorizacion = $listPInfoValorizacion;

        return  $this;


    }

    public function view(): View
    {
        return view('excel.InformeValorizacion', [
            'listPInfoValorizacion' => $this->listPInfoValorizacion
        ]);
    }
}
