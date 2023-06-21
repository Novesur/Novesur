<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClientExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listCliente = [];
    public function setGenerarExcel($listCliente)

    {
        $this->listCliente = $listCliente;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.cliente', [
            'cliente' => $this->listCliente
        ]);
    }
}
