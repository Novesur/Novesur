<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\MarcaExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Marca;

class MarcaController extends Controller
{

    public function listByIdMarcas(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdMarca = $request->nIdMarca;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = '') : $nIdMarca;
        $dato = Marca::where('id', $nIdMarca)->get();

        return $dato;
    }
    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $marca = new Marca;
        $marca->nombre =  mb_strtoupper($cNombre);
        $marca->save();
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;

        $dato = Marca::where('nombre', 'like', '%' . $cNombre . '%')->get();
        return $dato;
    }



    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdMarca = $request->nIdMarca;
        $Marca = Marca::where('id', $nIdMarca)->first();
        if ($Marca) {
            $Marca->nombre = $request->cNombre;
            $Marca->save();
        }
    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listMarca = json_decode($request->params['listMarca']);
        return (new MarcaExport)->setGenerarExcel($listMarca)->download('invoices.xlsx');
    }
}
