<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ModelotipoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelotipo;

class ModelotipoController extends Controller
{

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $Modelotipo = new Modelotipo;
        $Modelotipo->nombre =  mb_strtoupper($cNombre);
        $Modelotipo->save();
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cNombre = $request->cNombre;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $dato = Modelotipo::where('nombre', 'like', '%' . $cNombre . '%')->get();
        return $dato;
    }
    public function listByIdModelotipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdModelotipo = $request->nIdModelotipo;
        $nIdModelotipo = ($nIdModelotipo == NULL) ? ($nIdModelotipo = '') : $nIdModelotipo;
        $dato = Modelotipo::where('id', $nIdModelotipo)->get();

        return $dato;
    }
    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdModelotipo = $request->nIdModelotipo;
        $Modelotipo = Modelotipo::where('id', $nIdModelotipo)->first();
        if ($Modelotipo) {
            $Modelotipo->nombre = $request->cNombre;
            $Modelotipo->save();
        }
    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listModelotipo = json_decode($request->params['listModelotipo']);
        return (new ModelotipoExport)->setGenerarExcel($listModelotipo)->download('invoices.xlsx');
    }
}
