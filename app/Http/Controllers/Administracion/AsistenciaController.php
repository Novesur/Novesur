<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Imports\AsistenciaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AsistenciaController extends Controller
{
    public function import(Request $request){
   
$path= $request->file('select_file');
Excel::import(new AsistenciaImport, $path);
    }
}
