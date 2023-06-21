<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\File;

class FilesController extends Controller
{
    public function setRegistrarArchivo(Request $request){
        $file = $request->file;
        $bandera = Str::random(10);
        $filename = $file->getClientOriginalName();
        $fileserver = $bandera.'_'.$filename;
        Storage::putFileAs('public/articulos', $file, $fileserver);

        $file = new File();
        $file->path = asset('storage/articulos/'. $fileserver);
        $file->filename = $filename;
        $file->save();
        return response()->json(['idfile' => $file->id]);
    }
}
