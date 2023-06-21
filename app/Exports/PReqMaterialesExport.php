<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PReqMaterialesExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listPReqMateriales = [];
    public function setGenerarExcel($listPReqMateriales)

    {
        $this->listPReqMateriales = $listPReqMateriales;

        return  $this;


    }

    public function view(): View
    {
        return view('excel.PReqMateriales', [
            'PReqMateriales' => $this->listPReqMateriales
        ]);
    }
}
