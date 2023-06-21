<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InfoProdListExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listOrdenProduc = [];
    public function setGenerarExcel($listOrdenProduc)

    {
        $this->listOrdenProduc = $listOrdenProduc;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.InfoProduccionList', [
            'listOrdenProduc' => $this->listOrdenProduc
        ]);
    }
}
