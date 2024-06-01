<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\AlertasContabilidad;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function create(){
        $formatreq = date("Y-m-d");
        $alertasContabilidad = new AlertasContabilidad();
        $alertasContabilidad->fRegistro = $formatreq;
        $alertasContabilidad->tipo_id = $request->nidTipo;
        $alertasContabilidad->file_id = $oFotografia;
        $alertasContabilidad->catarticulo_id = $request->nidcatArt;
        $alertasContabilidad->descripcion = mb_strtoupper($request->cDescripcion);
        $alertasContabilidad->save();
        return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
    }
}
