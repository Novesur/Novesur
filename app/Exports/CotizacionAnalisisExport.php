<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CotizacionAnalisisExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $listAnalisisDetProductByDate = [];
    public function setGenerarExcel($listAnalisisDetProductByDate)

    {
        $this->listAnalisisDetProductByDate = $listAnalisisDetProductByDate;
        

        return  $this;
    }

    public function view(): View
    {
        return view('excel.CotizacionAnalisisFecha', [
            'listAnalisisDetProductByDate' => $this->listAnalisisDetProductByDate,

        ]);
    }
}
