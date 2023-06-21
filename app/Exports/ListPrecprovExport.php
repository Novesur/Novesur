<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ListPrecprovExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listOrdCompraxProveedor = [];
    public function setGenerarExcel($listOrdCompraxProveedor)

    {
        $this->listOrdCompraxProveedor = $listOrdCompraxProveedor;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.listOrdCompraxProveedor', [
            'listOrdCompraxProveedor' => $this->listOrdCompraxProveedor
        ]);
    }
}
