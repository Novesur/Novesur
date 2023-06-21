<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\FamiliaExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Familia;

class FamiliaController extends Controller
{

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $Familia = new Familia;
        $Familia->nombre =  mb_strtoupper($cNombre);
        $Familia->save();
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $dato = Familia::where('nombre', 'like', '%' . $cNombre . '%')->get();
        return $dato;
    }
    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdFamilia = $request->nIdFamilia;
        $Familia = Familia::where('id', $nIdFamilia)->first();
        if ($Familia) {
            $Familia->nombre = $request->cNombre;
            $Familia->save();
        }
    }
    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listFamilia = json_decode($request->params['listFamilia']);
        return (new FamiliaExport)->setGenerarExcel($listFamilia)->download('invoices.xlsx');
    }

    public function listByIdFamilia(Request $request){

        $dato= Familia::find($request->nIdFamilia);
        return $dato;

    }
}
