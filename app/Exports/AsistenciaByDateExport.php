<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class AsistenciaByDateExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listAsistenciaByDay = [];
    public function setGenerarExcel($listAsistenciaByDay)

    {
        $this->listAsistenciaByDay = $listAsistenciaByDay;
  
        return  $this;
    }

    public function view(): View
    {
        return view('excel.asistenciaByDate', [
            'asistenciaByDate' => $this->listAsistenciaByDay
        ]);
    }
}
