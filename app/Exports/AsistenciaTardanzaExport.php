<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AsistenciaTardanzaExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listAsistenciaTardanza = [];
    public function setGenerarExcel($listAsistenciaTardanza)

    {
        $this->listAsistenciaTardanza = $listAsistenciaTardanza;

        return  $this;
    }

    public function view(): View
    {
        return view('excel.asistenciaTardanza', [
            'listAsistenciaTardanza' => $this->listAsistenciaTardanza
        ]);
    }
}
