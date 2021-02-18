<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\PermissionRol;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{

    public function index(Request $request)
    {

        $dato = Permission::where('slug', 'like', '%' . $request->cSlug . '%')
            ->where('name', 'like', '%' . $request->cNombre . '%')->get();
        return $dato;
    }

    public function create(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
        $permission = new Permission;
        $permission->slug = $request->cSlug;
        $permission->name = $request->cNombre;
        $permission->save();
    }
    public function listPermisosById(Request $request)
    {
        $dato = Permission::where('id', '=', $request->nIdPermiso)->first();
        return $dato;
    }


    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdPermiso = $request->nIdPermiso;
        $permission = Permission::where('id', $nIdPermiso)->first();
        if ($permission) {
            $permission->slug = $request->cSlug;
            $permission->name = $request->cNombre;
            $permission->save();
        }
    }

    public function listUsuarioById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdUsuario = $request->nIdUsuario;
        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;

        $rpta = DB::select(
            'call sp_Rol_ListarPermisosByUser (?)',
            [
                $nIdUsuario

            ]
        );
        return $rpta;
    }

    public function RegistrarPermisosByUsuario(Request $request)
    {

      $nIdUsuario = $request->nIdUsuario;
         $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
        PermissionRol::where('rol_id', $request->nIdRol)->delete();


        $listPermiso = $request->listPermisosFilter;
        $listPermisoSize = sizeof($listPermiso);
        if ($listPermisoSize > 0) {
            foreach ($listPermiso as $key => $value) {
                if ($value['checked'] == true) {
                    $permissionRol = new  PermissionRol;
                    $permissionRol->rol_id = $request->nIdRol;
                    $permissionRol->permission_id = $value['id'];
                    $permissionRol->save();

                }
            }
        }
    }
}
