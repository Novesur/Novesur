<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ListPrecprodExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listOrdenPedidoXProduct = [];
    public function setGenerarExcel($listOrdenPedidoXProduct)

    {
        $this->listOrdenPedidoXProduct = $listOrdenPedidoXProduct;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.listOrdCompraxProduct', [
            'listOrdenPedidoXProduct' => $this->listOrdenPedidoXProduct
        ]);
    }
}
