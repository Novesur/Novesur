<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function create(Request $request)
    {
        $personal = new Personal;
        $personal->codigo = $request->cNumPersonal;
        $personal->nombres = $request->cNombres;
        $personal->ApPaterno = $request->cSecondname;
        $personal->ApMaterno = $request->cLastname;
        $personal->DNI = $request->cDni;
        $personal->zonal_id = $request->nIdZonal;
        $personal->cargo_personal_id = $request->nIdCargo;
        $personal->estado = 'A';
        $personal->save();
    }

    public function index(Request $request)
    {
        //Busqueda Todo
        if ($request->cFirstname == null && $request->cZonal == null && $request->cCargo == null && $request->cDNI == null) {
            $dato = Personal::with('cargo', 'zonal')->get();
            return $dato;
        }
        

        //Busqueda por Nombre
        if ($request->cDNI == null && $request->cZonal == null && $request->cCargo == null) {
            $dato = Personal::with('cargo', 'zonal')->where('nombres', 'like', '%' . $request->cFirstname . '%')->get();
            return $dato;
        }

        //Busqueda por Cargo
        if ($request->cZonal == null && $request->cDNI == null && $request->cFirstname == null) {
            $dato = Personal::with('cargo', 'zonal')->where('cargo_personal_id', $request->cCargo)->get();
            return $dato;
        }
        //Busqueda por Zonal
        if ($request->cCargo == null && $request->cDNI == null && $request->cFirstname == null) {
            $dato = Personal::with('cargo', 'zonal')->where('zonal_id',  $request->cZonal)->get();
            return $dato;
        }
    }

    public function delete(Request $request){
        //Personal::find($request->nIdPersonal)->delete();

        Personal::where('id', $request->nIdPersonal)->update(['estado' => 'I']);
    }

    public function list(){
       $dato= Personal::where('estado','A')->get();
       return $dato;
    }

    public function DatoPersonalById(Request $request){
        $dato = Personal::with('cargo', 'zonal')->where('id',$request->nIdPersonal)->first();
        return $dato;
    }

    public function edit(Request $request){
        $personal = Personal::where('id',$request->nIdPersonal)->first();
        if ($personal) {
            $personal->codigo = $request->cNumPersonal;
            $personal->nombres = $request->cNombres;
            $personal->ApPaterno = $request->cSecondname;
            $personal->ApMaterno = $request->cLastname;
            $personal->DNI = $request->cDni;
            $personal->zonal_id = $request->nIdZonal;
            $personal->cargo_personal_id = $request->nIdCargo;
            
            if($request->estado = true){
                $valorestado = 'A';
            }else{
                $valorestado = 'I' ;
            }

            $personal->estado = $valorestado;
            $personal->save();
        }

    }

}
