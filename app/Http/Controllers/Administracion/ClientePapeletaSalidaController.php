<?php

namespace App\Http\Controllers\Administracion;

use App\ClientsPapeletaSalida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientePapeletaSalidaController extends Controller
{
    public function BuscaClientePapeletaS(Request $request){

        $dato = ClientsPapeletaSalida::with('cliente','papeletasalida')->where('papeletasalida_id', $request->item)->get();
        return $dato;
    }
}
