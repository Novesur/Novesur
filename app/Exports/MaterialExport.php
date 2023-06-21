<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaterialExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listMaterial = [];
    public function setGenerarExcel($listMaterial)

    {
        $this->listMaterial = $listMaterial;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.material', [
            'material' => $this->listMaterial
        ]);
    }
}
