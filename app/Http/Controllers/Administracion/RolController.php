<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rol;
use App\PermissionRol;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function index(Request $request)
    {
        $dato = Rol::where('slug', 'like', '%' . $request->cSlug . '%')
            ->where('nombre', 'like', '%' . $request->cNombre . '%')->get();

        return $dato;
    }

    public function  listRolByUSer(Request $request)
    {
        $dato = Rol::where('id', $request->nIdRol)->get();
        return $dato;
    }

    public function create(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
        $rol = new Rol;
        $rol->slug =  mb_strtoupper($request->cSlug);
        $rol->nombre = mb_strtoupper($request->cNombre);
        $rol->save();
        $nidRol = $rol->id;

        $listpermiso = $request->listPermisosFilter;
        $listpermisoSize = sizeof($listpermiso);
        if ($listpermisoSize > 0) {
            foreach ($listpermiso as $key =>  $value) {
                if ($value['checked'] == true) {
                    $permisionRol = new PermissionRol;
                    $permisionRol->rol_id = $nidRol;
                    $permisionRol->permission_id = $value['id'];
                    $permisionRol->save();
                }
            }
        }
    }

    public function getListarPermisosByRol(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdRol = $request->nIdRol;
        $nIdRol = ($nIdRol == NULL) ? ($nIdRol = 0) : $nIdRol;
        $rpta = DB::select('call sp_Rol_getListarPermisosByRol (?)', [ 
            $nIdRol
        ]);
        return $rpta;
    }


    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdRol = $request->nIdRol;

        $rol = Rol::where('id', $nIdRol)->first();
        if ($rol) {
            $rol->nombre = $request->cNombre;
            $rol->slug = $request->cSlug;
            $rol->save();
        }

        PermissionRol::where('rol_id', $nIdRol)->delete();

        $listpermiso = $request->listPermisosFilter;
        $listpermisoSize = sizeof($listpermiso);
        if ($listpermisoSize > 0) {
            foreach ($listpermiso as $key =>  $value) {
                if ($value['checked'] == true) {
                    $permisionRol = new PermissionRol;
                    $permisionRol->rol_id = $request->nIdRol;
                    $permisionRol->permission_id = $value['id'];
                    $permisionRol->save();
                }
            }
        }
    }
}
