<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SubfamiliaExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listSubfamilia = [];
    public function setGenerarExcel($listSubfamilia)

    {
        $this->listSubfamilia = $listSubfamilia;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.Subfamilia', [
            'listSubfamilia' => $this->listSubfamilia
        ]);
    }
}
