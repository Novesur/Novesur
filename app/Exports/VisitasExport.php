<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VisitasExport implements FromView,ShouldAutoSize
{
    
     use Exportable;
    private $listVisitas = [];
    public function setGenerarExcel($listVisitas)

    {
        $this->listVisitas = $listVisitas;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.visitas', [
            'listSubfamilia' => $this->listVisitas
        ]);
    }
}
