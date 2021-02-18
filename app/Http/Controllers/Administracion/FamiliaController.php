<?php

namespace App\Http\Controllers\Administracion;

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
}
