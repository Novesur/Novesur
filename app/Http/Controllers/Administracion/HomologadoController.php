<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Homologacion;

class HomologadoController extends Controller
{
    public function index(){
        $homologado = Homologacion::all();
        return $homologado;
    }
}
