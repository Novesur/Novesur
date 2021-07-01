<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FamiliaExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listFamilia = [];
    public function setGenerarExcel($listFamilia)

    {
        $this->listFamilia = $listFamilia;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.familia', [
            'familia' => $this->listFamilia
        ]);
    }
}
