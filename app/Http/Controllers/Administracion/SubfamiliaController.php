<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\SubfamiliaExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Subfamilia;

class SubfamiliaController extends Controller
{

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $Subfamilia = new Subfamilia;
        $Subfamilia->nombre =  mb_strtoupper($cNombre);
        $Subfamilia->save();
    }

    public function store(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;

        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        //$dato = Subfamilia::where('nombre', 'like', '%' . $cNombre . '%')->get();
        $dato = Subfamilia::where('nombre', 'like', '%' . $cNombre . '%')->get();

        return $dato;
    }


    public function listByIdSubfamilia(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdSubfamilia = $request->nIdSubfamilia;
        $nIdSubfamilia = ($nIdSubfamilia == NULL) ? ($nIdSubfamilia = '') : $nIdSubfamilia;
        $dato = Subfamilia::where('id', $nIdSubfamilia)->get();
        return $dato;
    }

    public function listSubFamiliabyFamilia(Request $request)
    {

        $dato = Subfamilia::all();

        return $dato;
    }

    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdSubfamilia = $request->nIdSubfamilia;
        $Subfamilia = Subfamilia::where('id', $nIdSubfamilia)->first();

        if ($Subfamilia) {
            $Subfamilia->nombre = $request->cNombre;
            $Subfamilia->save();
        }
    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listSubfamilia = json_decode($request->params['listSubfamilia']);
        return (new SubfamiliaExport)->setGenerarExcel($listSubfamilia)->download('invoices.xlsx');
    }
}
