<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\MaterialExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;

class MaterialController extends Controller
{

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $marca = new Material;
        $marca->nombre =  mb_strtoupper($cNombre);
        $marca->save();
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;

        $dato = Material::where('nombre', 'like', '%' . $cNombre . '%')->get();
        return $dato;
    }
    public function listByIdMaterial(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdMaterial = $request->nIdMaterial;
        $nIdMaterial = ($nIdMaterial == NULL) ? ($nIdMaterial = '') : $nIdMaterial;
        $dato = Material::where('id', $nIdMaterial)->get();

        return $dato;
    }

    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdMaterial = $request->nIdMaterial;
        $Material = Material::where('id', $nIdMaterial)->first();
        if ($Material) {
            $Material->nombre = $request->cNombre;
            $Material->save();
        }
    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listMaterial = json_decode($request->params['listMaterial']);
        return (new MaterialExport)->setGenerarExcel($listMaterial)->download('invoices.xlsx');
    }
}
