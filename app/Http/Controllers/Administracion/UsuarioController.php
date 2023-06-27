<?php

namespace App\Http\Controllers\Administracion;

use App\Gradouser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    public function index(Request $request)
    {
            $dato = User::with('almacen')->where('firstname', 'like', '%' . $request->cFirstname . '%')
            ->where('username', 'like', '%' . $request->cUsername . '%')
            ->where('email', 'like', '%' . $request->cEmail . '%')->get();
        return $dato;
    }

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = new User;
        $user->firstname = strtoupper($request->cFirstname);
        $user->secondname = strtoupper($request->cSecondname);
        $user->lastname = strtoupper($request->cLastname);
        $user->username = $request->cUsername;
        $user->email = $request->cEmail;
        $user->celular = $request->cCelular;
        $user->roles_id = $request->nIdRol;
        $user->almacen_id = $request->nIdAlmacen;
        $user->password = Hash::make($request->cPassword);
        $user->gradousers_id = $request->nIdGradoAcad;
        $user->save();
    }

    public function listUsuarioById(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
        $nIdUsuario = $request->nIdUsuario;
        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
        $dato = User::with('roles')->where('id', $nIdUsuario)->first();
        return $dato;
    }


    public function edit(Request $request)
    {

        if (!$request->ajax()) return redirect('/');

        $Usuario = User::where('id', $request->nIdUsuario)->first();

        if ($Usuario) {
            $Usuario->firstname = strtoupper($request->cFirstname);
            $Usuario->secondname = strtoupper($request->cSecondname);
            $Usuario->lastname = strtoupper($request->cLastname);
            $Usuario->username = $request->cUsername;
            $Usuario->email = $request->cEmail;
            $Usuario->celular = $request->cCelular;
            $Usuario->roles_id = $request->nIdRol;
            $Usuario->almacen_id =  $Usuario->almacen_id;
            if ($request->cPassword != NULL) {
                $Usuario->password = Hash::make($request->cPassword);
            }
            $Usuario->gradousers_id = $request->nIdGradoAcad;
            $Usuario->save();
        }
    }


    public function ListarRolPermisosByUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdUsuario = $request->nIdUsuario;


        if (!$nIdUsuario) {
            $nIdUsuario = Auth::id();
        }

        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
        $rpta = DB::select('call sp_Usuario_getListarRolByUsuario (?)', [
            $nIdUsuario
        ]);
        return $rpta;
    }

    public function destroy(Request $request)
    {

        User::find($request->nIdUsuario)->delete();
    }

    public function getListarUsusarios(){
        $dato = User::where('roles_id',3)
        ->Orwhere('roles_id',1)
        ->Orwhere('roles_id',5)
        ->Orwhere('roles_id',13)
        ->Orwhere('roles_id',7)->get();
        return $dato;
    }

    public function getListarUsusariosbyId(Request $request){

       // $dato = User::where('id', $request->nIdUsuario)->where('roles_id',3)->get();

        $dato = User::where('id', $request->nIdUsuario)->get();
        return $dato;
    }

    public function getListarVendedores(){
        $dato = User::orderBy('firstname')->get();
        return $dato;
    }

    public function getListarGradoAcad(){
        $dato = Gradouser::orderBy('nombre')->get();
        return $dato;
    }

}
