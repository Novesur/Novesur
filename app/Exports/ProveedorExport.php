<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProveedorExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listProveedor = [];
    public function setGenerarExcel($listProveedor)

    {
        $this->listProveedor = $listProveedor;

        return  $this;


    }

    public function view(): View
    {
        return view('excel.Proveedor', [
            'proveedor' => $this->listProveedor
        ]);
    }
}
