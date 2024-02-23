<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Almacen;
use App\User;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = Almacen::all();

        return $dato;
    }

    public function AlmacenbyEstado()
    {
        $dato = Almacen::where('estado','A')->get();

        return $dato;
    }

    public function AlmacenLlegada(Request $request)
    {
        $user= User::where('id',$request->nIdUser)->first();
        $dato = Almacen::where('id',$user->almacen_id)->get();

        return $dato;
    }

}
