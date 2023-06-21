<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ModelotipoExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listModelotipo = [];
    public function setGenerarExcel($listModelotipo)

    {
        $this->listModelotipo = $listModelotipo;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.Modelotipo', [
            'Modelotipo' => $this->listModelotipo
        ]);
    }
}
