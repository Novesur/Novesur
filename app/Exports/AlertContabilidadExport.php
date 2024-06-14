<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class AlertContabilidadExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listAlertasByDate = [];
    public function setGenerarExcel($listAlertasByDate)

    {
        $this->listAlertasByDate = $listAlertasByDate;


        return  $this;
    }

    public function view(): View
    {
        return view('excel.alertContabilidad', [
            'listAlertasByDate' => $this->listAlertasByDate
        ]);
    }
}
