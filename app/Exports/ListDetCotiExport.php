<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ListDetCotiExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listDetProductByDate = [];
    public function setGenerarExcel($listDetProductByDate)

    {
        $this->listDetProductByDate = $listDetProductByDate;
      
        return  $this;
    }

    public function view(): View
    {
        return view('excel.listCotDetProduct', [
            'listDetProductByDate' => $this->listDetProductByDate
        ]);
    }
}
