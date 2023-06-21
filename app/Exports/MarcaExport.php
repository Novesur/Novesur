<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MarcaExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listMarca = [];
    public function setGenerarExcel($listMarca)

    {
        $this->listMarca = $listMarca;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.marcas', [
            'marcas' => $this->listMarca
        ]);
    }
}
