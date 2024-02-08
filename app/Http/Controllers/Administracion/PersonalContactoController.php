<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\PersonalContacto;
use Illuminate\Http\Request;

class PersonalContactoController extends Controller
{
    public function list(){
        $dato = PersonalContacto::all();
        return $dato;

    }
}
