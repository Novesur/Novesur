<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Asistencia1431Export implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listAsistenciaByDay1431 = [];
    public function setGenerarExcel($listAsistenciaByDay1431)

    {
        $this->listAsistenciaByDay1431 = $listAsistenciaByDay1431;


        return  $this;
    }

    public function view(): View
    {
        return view('excel.asistenciaByDay1431', [
            'listAsistenciaByDay1431' => $this->listAsistenciaByDay1431
        ]);
    }
}
