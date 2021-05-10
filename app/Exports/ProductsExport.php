<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsExport implements FromView
{
    use Exportable;
    private $listProductos = [];
    public function setGenerarExcel($listProductos)

    {
        $this->listProductos = $listProductos;

        return  $this;
    }

    public function view(): View
    {

        return view('excel.productos', [
            'productos' => $this->listProductos
        ]);
    }
}
