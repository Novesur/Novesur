<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Asistencia0113Export implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listAsistenciaByDay0113 = [];
    public function setGenerarExcel($listAsistenciaByDay0113)

    {
        $this->listAsistenciaByDay0113 = $listAsistenciaByDay0113;


        return  $this;
    }

    public function view(): View
    {
        return view('excel.asistenciaByDay0113', [
            'listAsistenciaByDay0113' => $this->listAsistenciaByDay0113
        ]);
    }
}
